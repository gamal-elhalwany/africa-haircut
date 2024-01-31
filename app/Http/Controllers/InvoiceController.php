<?php

namespace App\Http\Controllers;

use App\Models\Chair;
use App\Models\ChairProcess;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function OpenInvoiceMethod($id){

        $GetChair = Chair::where('id',$id)->get();
        $Products = Product::all();

        return view('dashboard.invoice.index',compact('Products','GetChair'));
    }

    public function CustomerSearchMethod(Request $request,$id){

        $CheckCustomer = Customer::where('mobile','like','%'.$request->mobile.'%')->first();
        if(!$CheckCustomer)
        {
            return redirect()->to('invoice/'. $id)->withErrors(['CustomerNotExist'=>'عفوا المتسخدم غير موجود']);
        }
        return redirect()->to('setInvoice/'.$id.'/'.$CheckCustomer->id);
    }

//
    public function SetInvoiceMethod($id,$Customer_id){
        $Customer = Customer::where('id',$Customer_id)->first();
        $Products = Product::all();
        $Chair = Chair::where('id',$id)->with('branch')->with('user')->first();
        return view('dashboard.invoice.set',compact('Customer','Products','Chair'));

    }

    public function SaveInvoiceMethod(Request $request,$id,$Customer_id){


         $this->validate($request, [
             'product' => 'required',
         ],
         [
             'required'=>'يرجي تحديد الخدمات للعميل ',
         ]);


          $ProductsName = [];
          $ProductsPrice = [];
          foreach ($request->product as $product){

                  $GetProductById = Product::where('id',$product)->get();

                   foreach ($GetProductById as $UpdateProduct){
                       $ProductsName[]=  $UpdateProduct->name;
                       $ProductsPrice[] = $UpdateProduct->customer_price;


                        if($UpdateProduct->status =='product') {
                            if ($UpdateProduct->distribution_value < 2 && $UpdateProduct->quantity > 0) {
                                $UpdateProduct->update([
                                    'distribution_value' => $UpdateProduct->value,
                                    'quantity' => $UpdateProduct->quantity - 1
                                ]);
                            } else {
                                if ($UpdateProduct->distribution_value > 0) {
                                    Product::where('id', $UpdateProduct->id)->update([
                                        'distribution_value' => $UpdateProduct->distribution_value - 1
                                    ]);
                                } else {
                                    return redirect()->to('setInvoice/' . $id . '/' . $Customer_id)->withErrors(['msg' => 'عفوا القيمه التقديريه للمنتج غير كافيه', 'name' => $UpdateProduct->name]);
                                }
                            }
                        }


                   }

          }

        $insertCustomerInvoice = Invoice::create([
            'customer_id'=>$Customer_id,
            'product_name'=>implode('|', $ProductsName),
            'price'=>implode('|', $ProductsPrice),
        ]);

        if ($insertCustomerInvoice){
            $InvoiceValueArray = explode('|', $insertCustomerInvoice->price);
            $InvoiceTotal = 0;
               foreach ($InvoiceValueArray as $ValueArray){
                   $InvoiceTotal +=  $ValueArray;
               }
                $SetChairProcess = ChairProcess::create([
                    'chair_id'=>$id,
                    'user_id'=> $request->emp_id,
                    'customer_id'=>$Customer_id,
                    'money'=>$InvoiceTotal
                ]);
               if ($SetChairProcess){
                   Chair::where('id',$id)->update([
                       'status'=>'available'
                   ]);
               }


        }

     return redirect()->to('customer_invoice/' . $Customer_id . '/' . $insertCustomerInvoice->id)->with('success','تم انشاء الفاتوره بنجاح');

    }

    public function CustomerCreateMethod(Request $request){
            $this->validate($request, [
                'name' => 'required',
                'mobile'=>'required',
                'email'=>['nullable','email','regex:/(.+)@(.+)\.(.+)/i'],
            ],
            [
                'required'=>'حقل  ( :attribute ) مطلوب ',
                'email'=>'صيغة البريد غير صحيحه'
            ]);

            $CreateCustomer= Customer::create($request->all());

            return redirect()->back()->with('success','تم تسجيل العميل بنجاح');

    }

    public function CustomerInvoiceMethod($customer_id,$invoice_id){

        $GetCustomerData = Customer::where('id',$customer_id)->first();
        $GetInvoice = Invoice::where('id',$invoice_id)->first();



        if ($GetInvoice){
            $InvoiceItems =[];
            $InvoiceItemsArray = explode('|', $GetInvoice->product_name);
            foreach ($InvoiceItemsArray as $InvoiceItemsLoop){
                $InvoiceItems[] = $InvoiceItemsLoop;
            }


            $InvoiceTotal = 0;
            $InvoiceValueArray = explode('|', $GetInvoice->price);
            foreach ($InvoiceValueArray as $ValueArray){
                $InvoiceTotal +=  $ValueArray;
            }
        }


        return view('dashboard/customers/customer_invoice',compact('GetCustomerData','InvoiceItems','InvoiceTotal'));
    }

}
