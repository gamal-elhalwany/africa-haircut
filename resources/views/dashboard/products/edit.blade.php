@extends('dashboard.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{asset('Design/css/products/main.css')}}">
@endpush
@section('title','تعديل منتج')

@section('body')
    <div class="body">
        <div class="edit-products-container">

            <div class="edit-products-head">
                <a class="btn btn-info" href="{{ route('dashboard.products.index') }}">
                    <i style="vertical-align: middle" class="fa-solid fa-backward"></i>
                    رجوع
                </a>
                <h5> إضافة منتج جديده </h5>
            </div>


            <div class="edit-products-content">
                @foreach($GetProductByID as $Product)
                <form action="{{route('dashboard.products.update',$Product->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="input-style">
                        <label>
                            @if($Product->status=='product')
                            أسم المنتج
                            @else
                                أسم الخدمة
                            @endif
                        </label>
                        <input type="text" name="name" class="form-control" value="{{$Product->name}}" placeholder="أسم المنتج">
                    </div>
                    <div class="input-style">
                        <label>السعر للعميل</label>
                        <input type="number" name="customer_price" class="form-control" value="{{$Product->customer_price}}"  placeholder="السعر للعميل">
                    </div>
                    <div class="input-style">
                        <label>الفرع </label>
                        <select name="branch_id" class="form-control">
                            @foreach($Branches as $Branch)
                                <option  @if($Product->branch->id == $Branch->id) selected @endif value="{{$Branch->id}}">{{$Branch->name}}</option>
                            @endforeach
                        </select>
                    </div>
{{--                    <div class="input-style">--}}
{{--                        <label> الحاله</label>--}}
{{--                        <select name="status" class="form-control" required>--}}
{{--                            <option @if($Product->status=='product') selected @endif value="product">منتج</option>--}}
{{--                            <option @if($Product->status=='service') selected @endif  value="service">خدمة</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}


                    @if($Product->status=='product')

                        <div class="input-style">
                            <label>كود المنتج</label>
                            <input type="text" name="code" class="form-control" value="{{$Product->code}}" placeholder="كود المنتج">
                        </div>

                        <div class="input-style">
                            <label>سعر الشراء</label>
                            <input type="number" name="buy_price" class="form-control" value="{{$Product->buy_price}}" placeholder="سعر الشراء">
                        </div>


                        <div class="input-style">
                            <label>سعر بيع المنتج</label>
                            <input type="number" name="sell_price" class="form-control" value="{{$Product->sell_price}}" placeholder="سعر بيع المنتج">
                        </div>

                        <div class="input-style">
                            <label>القيمه التقديريه</label>
                            <input type="number" name="distribution_value" class="form-control" value="{{$Product->distribution_value}}" placeholder="القيمه التقديريه">
                        </div>

                        <div class="input-style">
                            <label>الكميه</label>
                            <input type="number" name="quantity" class="form-control" value="{{$Product->quantity}}" placeholder=" الكميه">
                        </div>


                    @endif

                    <div class="input-style">
                        <button class="btn btn-success">إضاف الأن</button>
                    </div>

                </form>
                @endforeach
            </div>


            </div>


    </div>
@endsection
