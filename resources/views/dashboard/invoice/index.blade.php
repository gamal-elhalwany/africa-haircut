@extends('dashboard.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('Design/css/invoice/main.css')}}">
@endpush
@section('title','فتح فاتوره - '.'كرسي : '.$GetChair[0]->number)

@section('body')
<div class="body">
    @foreach($GetChair as $Chair)
    <div class="invoice-container">

        <div class="invoice-head">
            <a class="btn btn-info" href="{{ route('dashboard.index') }}">
                <i style="vertical-align: middle" class="fa-solid fa-backward"></i>
                الرئيسية
            </a>
            <h5>
                <img src="{{asset('Design/images/busy.png')}}"> : {{$Chair->number}}

            </h5>
        </div>
        <ul>
            @if($errors->has('CustomerNotExist'))
                <li class="alert alert-danger">{{ $errors->first('CustomerNotExist') }}</li>
            @endif

        </ul>
        <div class="invoice-content">

            <form  class="search" action="{{route('customer.search',$Chair->id)}}" method="POST">
                @csrf
                <div class="input-style">
                    <input type="text" id="mobile" name="mobile" class="form-control" placeholder="رقم موبيل العميل">
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>

            <form  action="/customer/create" class="create-customer" method="POST">
                @csrf
                <div class="input-style">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <input type="text" id="name" name="name" class="form-control" placeholder="أسم العميل">
                    <div class="create-customer-meg">
                        @if($errors->has('name'))
                            <div class="alert alert-danger">{{ $errors->first('name')}}</div>
                        @endif
                    </div>
                </div>
                <div class="input-style">
                    <input type="text" id="mobile" name="mobile" class="form-control" placeholder="رقم الموبيل">
                    <div class="create-customer-meg">
                        @if($errors->has('mobile'))
                            <div class="alert alert-danger">{{ $errors->first('mobile')}}</div>
                        @endif
                    </div>
                </div>

                <div class="input-style">
                    <input type="email" id="email" name="email" class="form-control" placeholder="البريد الالكتروني">
                    <div class="create-customer-meg">
                        @if($errors->has('email'))
                            <div class="alert alert-danger">{{ $errors->first('email')}}</div>
                        @endif
                    </div>
                </div>
                <div class="input-style">
                    <button type="submit" class="btn btn-primary">
                        إضافة العميل
                    </button>
                </div>
            </form>


        </div>




    </div>
    @endforeach
</div>


@endsection
