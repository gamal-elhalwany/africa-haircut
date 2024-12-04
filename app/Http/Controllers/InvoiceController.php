<?php

namespace App\Http\Controllers;

use App\Models\Chair;
use App\Models\ChairProcess;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function CustomerSearchMethod(Request $request, $id)
    {
        $CheckCustomer = Customer::where('mobile', 'like', '%' . $request->mobile . '%')->first();
        if (!$CheckCustomer) {
            toastr()->error('عفوا العميل غير موجود');
            return redirect()->to('invoice/' . $id);
        }
        return redirect()->to('setInvoice/' . $id . '/' . $CheckCustomer->id);
    }

    public function OpenInvoiceMethod(Request $request, $id)
    {
        $getChair = Chair::where('id', $id)->get();
        $products = Product::all();

        $customer = Customer::when($request->input('mobile'), function ($query, $mobile) {
            $query->where('mobile', $mobile);
        })->first();

        $chairProcesses = ChairProcess::where('check_out', null)->get();
        $foundProcess = false;

        foreach ($chairProcesses as $process) {
            if ($process) {
                if ($process->chair_id == $id) {
                    $foundProcess = true;
                    return view('dashboard.invoice.index', compact('products', 'getChair', 'customer'));
                }
            }
        }

        if (!$foundProcess) {
            toastr()->error('هذاالكرسي ليس محجوراً حتي الآن');
            return redirect()->route('dashboard.index');
        }
    }

    public function CustomerCreateMethod(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'mobile' => 'required|unique:customers,mobile',
                'email' => ['nullable', 'email', 'regex:/(.+)@(.+)\.(.+)/i', 'unique:customers,email'],
            ],
            [
                'required' => 'حقل  ( :attribute ) مطلوب ',
                'email' => 'صيغة البريد غير صحيحه',
                'email.unique' => 'هذا الأيميل مسجل بالفعل.',
                'mobile.unique' => 'هذا الرقم مسجل بالفعل.'
            ]
        );

        $CreatedCustomer = Customer::create($request->all());

        toastr()->success('تم تسجيل العميل بنجاح');
        return redirect()->route('set.invoice', [$request->id, $CreatedCustomer->name]);
    }

    public function SetInvoiceMethod($id, Customer $customer)
    {
        $Products = Product::all();
        $Chair = Chair::where('id', $id)->with('branch')->with('user')->first();
        $chairProcess = ChairProcess::where('chair_id', $id)->whereNull('check_out')->first();

        if ($chairProcess) {
            if ($chairProcess->chair_id == $id) {
                return view('dashboard.invoice.set', compact('customer', 'Products', 'Chair'));
            }
        } else {
            toastr()->error('لا يوجد عمليات لهذا الكرسي.');
            return redirect()->route('dashboard.index');
        }
    }

    public function SaveInvoiceMethod(Request $request, $id, Customer $customer)
    {
        $this->validate(
            $request,
            ['products' => 'required'],
            ['required' => 'يرجي تحديد الخدمات للعميل أو الكمية.',],
        );

        DB::beginTransaction();
        $invoice = Invoice::create([
            'customer_id' => $customer->id,
            'total_cost' => 0.00,
        ]);

        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $serialNumber = 'INV-' . $currentYear . '-' . str_pad($currentMonth, 2, '0', STR_PAD_LEFT) . '-' . str_pad($invoice->id, 4, '0', STR_PAD_LEFT);

        foreach ($request->input('products') as $productId => $productData) {
            if (isset($productData['selected'])) {
                $product = Product::find($productId);

                if ($product->quantity >= $productData['qty']) {

                    $orderItem = OrderItem::create([
                        'invoice_id' => $invoice->id,
                        'product_id' => $productData['selected'],
                        'product_name' => $product->name,
                        'price' => $product->sell_price * $productData['qty'],
                        'qty' => $productData['qty'],
                    ]);

                    // Decrease product stock.
                    $product->decrement('quantity', $productData['qty']);
                } else {
                    toastr()->info("لا يوجد مخزون كاف من هذا المنتج {$product->name}.");
                    return back();
                }
            }
        }

        $chair = Chair::where('id', $id)->first();
        $chair->status = 'available';
        $chair->save();

        $chairProcesses = ChairProcess::where('chair_id', $id)->where('check_out', null)->first();
        if ($chairProcesses) {
            $chairProcesses->check_out = Carbon::now();
            $chairProcesses->save();
        }

        $totalCost = 0;
        $invoiceItems = OrderItem::where('invoice_id', $invoice->id)->with('product')->get();

        foreach ($invoiceItems as $item) {
            $totalCost += $item->price;
        }

        $invoice->total_cost = $totalCost;
        $invoice->serial_number = $serialNumber;
        $invoice->save();

        DB::commit();
        DB::rollBack();
        return redirect()->route('customer.invoice', $customer->name)->with('success', 'تم تسجيل الفاتورة بنجاح');
    }

    public function CustomerInvoiceMethod(Customer $customer)
    {
        $customerInvoices = Invoice::where('customer_id', $customer->id)->with('customer')
            ->where('created_at', Carbon::now())->get();

        if ($customerInvoices->count() > 0) {
            $totalPrice = 0;
            foreach ($customerInvoices as $invoice) {
                $invoiceItems = OrderItem::where('invoice_id', $invoice->id)->with('product')->get();
                foreach ($invoiceItems as $item) {
                    $totalPrice += $item->price;
                }
            }
            return view('dashboard/customers/customer_invoice', compact('customerInvoices', 'invoiceItems', 'customer', 'totalPrice'));
        }
        return redirect()->back();
    }

    public function collectInvoice(Customer $customer, $id)
    {
        $invoice = Invoice::find($id);
        toastr()->success('تم تحصيل وطباعة الفاتورة بنجاح');
        return redirect()->route('dashboard.index');
    }

    public function allInvoices()
    {
        $user = auth()->user();
        if ($user) {
            $invoices = Invoice::with('customer')->get();
            return view('dashboard/invoice/all-invoices', compact('invoices'));
        }
        return redirect('/');
    }
}
