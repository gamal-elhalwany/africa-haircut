@extends('dashboard.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('Design/css/products/main.css')}}">
@endpush
@section('title','إضافة منتج جديد')

@section('body')
<div class="body">
    <div class="create-products-container">

        <div class="create-products-head">
            <a class="btn btn-info" href="{{ route('dashboard.products.index') }}">
                <i style="vertical-align: middle" class="fa-solid fa-backward"></i>
                رجوع
            </a>

            <h5> إضافة منتج جديد </h5>
        </div>


        <div class="create-products-content">
            <form action="{{route('dashboard.products.store')}}" method="POST">
                @csrf
                <div class="input-style">
                    <select name="status" onchange="ProductStateHideInputs()" id="product_state_select" class="form-control" required>
                        <option value="product">منتج</option>
                        <option value="service">خدمة</option>
                    </select>
                </div>

                <div class="input-style">
                    <input type="text" name="name" class="form-control" placeholder="أسم المنتج او الخدمة">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-style">
                    <select class="form-control" name="category_id">
                        <option>Choose Category</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-style">
                    <textarea name="description" class="form-control" placeholder="وصف المنتج او الخدمة"></textarea>
                </div>

                <div id="product_state">
                    <div class="input-style">
                        <input type="text" name="code" class="form-control" placeholder="كود المنتج">
                    </div>
                    <div class="input-style">
                        <input type="number" name="buy_price" class="form-control" placeholder="سعر الشراء">
                    </div>

                    <div class="input-style">
                        <input type="number" name="sell_price" class="form-control" placeholder="سعر بيع المنتج">
                        @error('sell_price')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <!-- <div class="input-style">
                        <input type="number" name="distribution_value" class="form-control" placeholder="القيمه التقديريه">
                    </div> -->

                    <div class="input-style">
                        <input type="number" name="quantity" class="form-control" placeholder="الكميه">
                    </div>
                </div>

                <div class="input-style">
                    <select name="branch_id" class="form-control">
                        @foreach($Branches as $Branch)
                        <option value="{{$Branch->id}}">{{$Branch->name}}</option>
                        @endforeach
                    </select>
                    @error('branch_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="input-style">
                    <button class="btn btn-success">إضافة الأن</button>
                </div>

            </form>
        </div>


    </div>


</div>
@endsection