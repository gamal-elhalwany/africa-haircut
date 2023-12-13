<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Products = Product::all();
        return view('dashboard.products.index',compact('Products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Branches = Branch::all();
        return view('dashboard.products.create',compact('Branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Product::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'code'=>$request->code,
            'buy_price'=>$request->buy_price,
            'sell_price'=>$request->sell_price,
            'customer_price'=>$request->customer_price,
            'distribution_value'=>$request->distribution_value,
            'quantity'=>$request->quantity,
            'value'=>$request->distribution_value,
            'net_profit'=>($request->sell_price)  - ($request->buy_price),
            'status'=>$request->status,
            'branch_id'=>$request->branch_id,
        ]);
        if ($request->status =="service"){
            $SuccessMsg = 'تم إضافة الخدمة بنجاح';
        } else {
            $SuccessMsg = 'تم إضافة المنتج بنجاح';
        }

        return redirect()->route('dashboard.products.index')->with('success',$SuccessMsg);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $GetProductByID = Product::where('id',$id)->get();
        $Branches = Branch::all();
        return view('dashboard.products.edit',compact('GetProductByID','Branches'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $UpdateProduct = Product::find($id)->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'code'=>$request->code,
            'buy_price'=>$request->buy_price,
            'sell_price'=>$request->sell_price,
            'customer_price'=>$request->customer_price,
            'distribution_value'=>$request->distribution_value,
            'quantity'=>$request->quantity,
            'value'=>$request->distribution_value,
            'net_profit'=>($request->sell_price)  - ($request->buy_price),
            'status'=>$request->status,
            'branch_id'=>$request->branch_id,
        ]);
        return redirect()->route('dashboard.products.index')->with('success','تم تعديل المنتج المنتج بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Product::where('id',$id)->delete();
        return redirect()->route('dashboard.products.index')->with('success','تم حذف المنتج بنجاح');

    }
}
