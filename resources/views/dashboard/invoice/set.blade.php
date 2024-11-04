@extends('dashboard.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('Design/css/invoice/main.css')}}">
@endpush
@section('title','فتح فاتوره')

@section('body')
<div class="body">

    <div class="invoice-container">
        @if(session('success'))
        <div class="alert alert-success" role="alert">
            <strong>
                {{session('success')}}
            </strong>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-success" role="alert">
            <strong>
                {{session('error')}}
            </strong>
        </div>
        @endif
        <div class="invoice-head">
            <a class="btn btn-info" href="{{ route('dashboard.index') }}">
                <i style="vertical-align: middle" class="fa-solid fa-backward"></i>
                الرئيسية
            </a>
        </div>

        <div class="invoice-content">
            <div class="invoice-meg">
                @if($errors->has('name') && $errors->has('name'))
                <div class="error">{{ $errors->first('msg') . '[ '. $errors->first('name') .' ]' }}</div>
                @endif
                <ul>
                    @if($errors->has('product'))
                    <li class="alert alert-danger">{{ $errors->first('product') }}</li>
                    @endif
                </ul>
            </div>

            <div class="create-invoice-company-name">
                <h2>
                    {{env('APP_NAME')}}
                    <img src="{{env('App_Design_Url').'/Design/images/invoice_logo.png'}}">
                </h2>
                <h4> أسم العميل : {{$customer->name}}</h4>
            </div>

            <form action="/saveInvoice/{{$Chair->id.'/'.$customer->id}}" method="POST">
                @csrf
                <div class="input-style">
                    <input type="hidden" name="emp_id" value="{{$Chair->user->id}}">
                </div>
                @foreach($Products as $Product)
                <div class="input-style checkBox">
                    <label for="{{$Product->name}}">{{$Product->name}}</label>
                    <input type="checkbox" id="{{$Product->name}}" name="product[]" value="{{$Product}}" />
                </div>
                @endforeach

                <div class="invoice-footer">
                    <h5> الموظف : {{$Chair->user->name}} </h5>
                    <h5> الفرع : {{$Chair->branch->name}} </h5>
                </div>
                <button type="submit" class="btn btn-primary">حفظ</button>
            </form>
        </div>
    </div>
</div>
@endsection