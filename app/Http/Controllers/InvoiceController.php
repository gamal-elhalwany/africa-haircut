<?php

namespace App\Http\Controllers;

use App\Models\Chair;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderItem;
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

        return view('dashboard.invoice.index', compact('products', 'getChair', 'customer'));
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
        return view('dashboard.invoice.set', compact('customer', 'Products', 'Chair'));
    }

    public function SaveInvoiceMethod(Request $request, $id, Customer $customer)
    {
        $this->validate(
            $request,
            ['product' => 'required', 'qty' => 'required', 'numeric',],
            ['required' => 'يرجي تحديد الخدمات للعميل ',]
        );

        DB::beginTransaction();
        $invoice = Invoice::create([
            'customer_id' => $customer->id,
        ]);

        foreach ($request->product as $index => $singleProduct) {
            $updatedProduct = json_decode($singleProduct);

            $product = Product::find($updatedProduct->id);

            if ($product) {
                $qty = $request->qty[$index];

                // Creating order item
                $orderItem = OrderItem::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->sell_price,
                    'qty' => $qty,
                ]);

                $product->quantity -= $qty;
                $product->save();
            } else {
                toastr()->error("Product with ID {$updatedProduct->id} not found.");
            }
        }



        // $totalCost = OrderItem::where('invoice_id', $invoice->id)->sum('price');
        // $ChairProcess = ChairProcess::create([
        //     'chair_id' => $id,
        //     'customer_id' => $customer->id,
        //     'user_id' => $chair->user->id,
        //     'cost' => $totalCost,
        // ]);

        $chair = Chair::where('id', $id)->first();
        $chair->status = 'available';
        $chair->save();

        DB::commit();
        DB::rollBack();
        return redirect()->route('customer.invoice', $customer->name)->with('success', 'تم تسجيل الفاتورة بنجاح');
    }

    public function CustomerInvoiceMethod(Customer $customer)
    {
        $customerInvoices = Invoice::where('customer_id', $customer->id)->with('customer')->get();

        if ($customerInvoices->count() > 0) {
            $totalPrice = 0;
            foreach ($customerInvoices as $invoice) {
                $invoiceItems = OrderItem::where('invoice_id', $invoice->id)->with('product')->get();
                foreach ($invoiceItems as $item) {
                    $totalItemPrice = $item->price * $item->qty;
                    $totalPrice += $totalItemPrice;
                }
            }
            return view('dashboard/customers/customer_invoice', compact('customerInvoices', 'invoiceItems', 'customer', 'totalPrice'));
        }
        return redirect()->back();
    }

    public function deleteInvoice(Customer $customer, $id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();
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
