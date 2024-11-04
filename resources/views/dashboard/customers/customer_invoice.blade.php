
@extends('dashboard.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{asset('Design/css/customer/main.css')}}">
@endpush
@section('title','فاتورة '. ' | ' . $customer->name)

@section('body')
    <div class="body">

        <div class="customer-invoice-data-container">

            <div class="print-btn">
                <button onclick="window.print()" class="btn btn-primary"><i class="fa-solid fa-print"></i> طباعة</button>
            </div>

            <div class="customer-invoice-data-content">
                <div class="customer-invoice-data">
                    <div class="customer-invoice-data-head">
                        <h2>
                            {{env('APP_NAME')}}
                            <img src="{{env('App_Design_Url').'/Design/images/invoice_logo.png'}}">
                        </h2>
                    </div>

                    <div class="customer-invoice-data-body">
                        <div class="customer-name">
                            <h3>{{$customer->name}}</h3>
                        </div>
                        <h6>  الخدمات و المنتجات  </h6>

                        <div class="products-services">
                             <ul class="products-services-list-items">
                                @foreach($custormerInvoices as  $item)
                                    <li class="products-services-item">
                                        {{$loop->iteration}}- {{$item->product_name}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>


                    </div>

                    <div class="customer-invoice-data-footer">
                        اجمالي الفاتورة :   {{$totalPrice}}£
                    </div>

            </div>
        </div>

    </div>


@endsection
