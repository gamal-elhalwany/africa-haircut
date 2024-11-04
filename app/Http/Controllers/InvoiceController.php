<?php

namespace App\Http\Controllers;

use App\Models\Chair;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;
use App\Models\ChairProcess;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function CustomerSearchMethod(Request $request, $id)
    {

        $CheckCustomer = Customer::where('mobile', 'like', '%' . $request->mobile . '%')->first();
        if (!$CheckCustomer) {
            return redirect()->to('invoice/' . $id)->withErrors(['CustomerNotExist' => 'عفوا المتسخدم غير موجود']);
        }
        return redirect()->to('setInvoice/' . $id . '/' . $CheckCustomer->id);
    }

    public function OpenInvoiceMethod($id)
    {
        $getChair = Chair::where('id', $id)->get();
        $products = Product::all();
        return view('dashboard.invoice.index', compact('products', 'getChair'));
    }

    public function CustomerCreateMethod(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'mobile' => 'required',
                'email' => ['nullable', 'email', 'regex:/(.+)@(.+)\.(.+)/i'],
            ],
            [
                'required' => 'حقل  ( :attribute ) مطلوب ',
                'email' => 'صيغة البريد غير صحيحه'
            ]
        );

        $CreatedCustomer = Customer::create($request->all());

        return redirect()->route('set.invoice', [$request->id, $CreatedCustomer->name])->with('success', 'تم تسجيل العميل بنجاح');
    }

    public function SetInvoiceMethod($id, Customer $customer)
    {
        $Products = Product::all();
        $Chair = Chair::where('id', $id)->with('branch')->with('user')->first();
        return view('dashboard.invoice.set', compact('customer', 'Products', 'Chair'));
    }

    public function SaveInvoiceMethod(Request $request, $id, $Customer_id)
    {
        $this->validate(
            $request,
            ['product' => 'required',],
            ['required' => 'يرجي تحديد الخدمات للعميل ',]
        );

        DB::beginTransaction();
        $invoice = Invoice::create([
            'customer_id' => $Customer_id,
        ]);

        foreach ($request->product as $singleProduct) {
            $updatedProduct = json_decode($singleProduct);
            $orderItems = OrderItem::create([
                'invoice_id' => $invoice->id,
                'product_id' => $updatedProduct->id,
                'product_name' => $updatedProduct->name,
                'price' => $updatedProduct->sell_price,
            ]);
        }

        $totalCost = OrderItem::where('invoice_id', $invoice->id)->sum('price');

        $chair = Chair::where('id', $id)->first();
        $ChairProcess = ChairProcess::create([
            'chair_id' => $id,
            'customer_id' => $Customer_id,
            'user_id' => $chair->user->id,
            'cost' => $totalCost,
        ]);

        $chair->status = 'available';
        $chair->save();

        DB::commit();
        DB::rollBack();
        return redirect()->route('dashboard.index')->with('success', 'تم تسجيل الفاتورة بنجاح');
    }

    public function CustomerInvoiceMethod(Customer $customer)
    {
        $custormerInvoices = Invoice::where('customer_id', $customer->id)->with('customer')->get();
        if ($custormerInvoices->count() > 0) {
            foreach ($custormerInvoices as $invoice) {
                $totalPrice = $invoice->sum('price');
            }
            return view('dashboard/customers/customer_invoice', compact('custormerInvoices', 'customer', 'totalPrice'));
        }
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
