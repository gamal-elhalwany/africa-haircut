@extends('dashboard.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('Design/css/invoice/main.css')}}">
@endpush
@section('title','فتح فاتوره - '.'كرسي : '.$getChair[0]->number)

@section('body')
<div class="body">
    @foreach($getChair as $Chair)
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

            <!-- Search Form -->
            <form class="search" action="{{route('customer.search',$Chair->id)}}" method="POST">
                @csrf
                <div class="input-style">
                    <input type="text" id="mobile" name="mobile" class="form-control" placeholder="رقم موبايل العميل">
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
            <!-- Search Form -->

            <form action="{{ route('customer.create', $getChair[0]->id) }}" class="create-customer" method="POST">
                @csrf
                <div class="input-style">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <input type="text" id="name" name="name" class="form-control" placeholder="أسم العميل" value="{{ request('mobile') ? ($customer->name ?? '') : '' }}">
                    <div class="create-customer-meg">
                        @if($errors->has('name'))
                        <div class="alert alert-danger">{{ $errors->first('name')}}</div>
                        @endif
                    </div>
                </div>
                <div class="input-style">
                    <input type="text" id="mobile" name="mobile" class="form-control" placeholder="رقم الموبيل" value="{{ request('mobile') ? ($customer->mobile ?? '') : '' }}">
                    <div class="create-customer-meg">
                        @if($errors->has('mobile'))
                        <div class="alert alert-danger">{{ $errors->first('mobile')}}</div>
                        @endif
                    </div>
                </div>

                <div class="input-style">
                    <input type="email" id="email" name="email" class="form-control" placeholder="البريد الالكتروني" value="{{ request('mobile') ? ($customer->email ?? '') : '' }}">
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
                @if(request('mobile') !== null)
                @if($customer)
                <a href="{{route('set.invoice', [$getChair[0]->id, $customer->name ?? ''])}}" class="text-dark">هذا العميل مسجل لدينا بالفعل ويمكنك فتح فاتورة له بالضغط هنا.</a>
                @endif
                @endif
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection