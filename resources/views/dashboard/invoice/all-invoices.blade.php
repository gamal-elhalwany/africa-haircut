@extends('dashboard.layouts.app')
<link rel="stylesheet" href="{{asset('Design/css/users/main.css')}}">
@section('title','لوحة التحكم ' . ' | ' .' الفواتير')

@section('body')
<div class="body">
    <div class="show-users-head-content">
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
        <div class="pull-right">
            <h2 class="btn btn-success">جميع الفواتير</h2>
        </div>
    </div>
    <div class="show-users">
        <div class="main-body">
            <div class="row">
                @foreach($invoices as $invoice)
                <div class="col-md-4 mt-2">
                    <div class="card" style="width: 18rem;">
                        <div class="card-header">
                            <strong>
                                <label>أسم العميل:</label>
                                {{$invoice->customer->name}}
                            </strong>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>
                                    <label>أسم المنتج:</label>
                                    {{$invoice->product_name}}
                                </strong>
                            </li>
                            <li class="list-group-item">A second item</li>
                            <li class="list-group-item">A third item</li>
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection