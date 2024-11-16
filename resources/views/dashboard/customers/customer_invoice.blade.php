@extends('dashboard.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('Design/css/customer/main.css')}}">
@endpush
@section('title','فاتورة '. ' | ' . $customer->name)

@section('body')
<div class="body">

    <div class="customer-invoice-data-container">

        <div class="col-md-8">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>

        <form action="{{route('customer.invoice.collect', [$customerInvoices[0]->customer->name, $customerInvoices[0]->id])}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="print-btn">
                <button type="submit" onclick="window.print()" class="btn btn-primary"><i class="fa-solid fa-print"></i> طباعة</button>
            </div>
        </form>

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
                    <h6> الخدمات و المنتجات </h6>

                    <div class="products-services">
                        <ul class="products-services-list-items">
                            @foreach($invoiceItems as $item)
                            <li class="products-services-item">
                                <strong>{{$loop->iteration}}- {{$item->product_name}} | السعر: {{$item->price}} ج</strong>
                                |
                                <strong>الكمية: {{$item->qty}}</strong>
                            </li>
                            @endforeach
                        </ul>
                    </div>


                </div>

                <div class="customer-invoice-data-footer">
                    اجمالي الفاتورة : {{$totalPrice}}£
                </div>

            </div>
        </div>

    </div>


    @endsection