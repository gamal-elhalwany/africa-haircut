@extends('dashboard.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{asset(env('App_Design_Url').'/Design/css/products/main.css')}}">
@endpush
@section('title','المنتجات')

@section('body')
    <div class="body">
            <div class="products-container">
                <div class="products-head">
                    <a class="btn btn-success" href="{{ route('dashboard.products.create') }}">
                        اضافة منتج او خدمة
                    </a>
                    <h5>جميع المنتجات</h5>
                </div>


            <div class="products-content">

                    <div class="products-success-msg">
                        @if ($message = Session::get('success'))
                            <p>{{ $message }}</p>
                        @endif
                    </div>

                    <div class="product-info">
                        @foreach ($Products as $Product)

                            <div class="product">
                                <h5>
                                    النوع :
                                    @if($Product->status =='product')
                                        منتج
                                    @else
                                        خدمة
                                    @endif
                                </h5>
                                    <p>الاسم : {{$Product->name}}</p>
{{--                                    <p>السعر للعميل : {{$Product->customer_price}}</p>--}}

                                    <div class="product-info-footer">
                                        <a class="btn btn-info" href="{{ route('dashboard.products.show',$Product->id) }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a class="btn btn-primary" href="{{ route('dashboard.products.edit',$Product->id) }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{route('dashboard.products.destroy', $Product->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                            </div>

                        @endforeach
                    </div>

            </div>
            </div>
        </div>
@endsection
