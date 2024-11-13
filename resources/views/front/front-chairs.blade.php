@extends('layout/header')
@section('title', 'أفريكانا ' . '||' .' الكراسي')

@section('content')

<div class="container">
    <h2 class="mt-3 mb-3 p-3 text-white text-center bg-dark">الكراسي المتاحة</h2>
    <div class="row">
        <div class="col-md-12">
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

        @if($chairs->count() > 0)
        @foreach($chairs as $chair)
        <div class="col-md-3">
            <div class="chair-content">
                <div class="chair">
                    <div class="chair-direct">
                        <img src="https://l.top4top.io/p_26550dd1k1.jpg" height="100%" width="100%">
                        <div class="chair-details">
                            <h6> كرسي : {{$chair->number}} </h6>
                            <p> الدور : {{$chair->floor}} </p>
                            <p> فرع : {{$chair->branch->name}} </p>
                        </div>

                        <form action="{{route('store.appointment')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="customer_name">الأسم:</label>
                                <input type="text" name="customer_name" class="form-control mb-2 p-2" required/>
                                @error('customer_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <label for="customer_name">رقم الموبايل:</label>
                                <input type="text" name="mobile" class="form-control mb-2 p-2" required/>
                                @error('mobile')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <input type="hidden" name="chair_id" value="{{$chair->id}}">
                                <input type="hidden" name="branch_id" value="{{$chair->branch->id}}">

                                <!-- Date Selection -->
                                <div class="mb-3">
                                    <label for="appointment_date" class="form-label">أختر التاريخ</label>
                                    <input type="date" name="appointment_date" id="appointment_date" class="form-control" min="{{ now()->toDateString() }}" required>
                                    @error('appointment_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Time Selection -->
                                <div class="mb-3">
                                    <label for="start_at" class="form-label">أختر الوقت</label>
                                    <input type="time" name="start_at" id="start_at" class="form-control" required>
                                    @error('start_at')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary mb-3">احجز موعداً الاَن</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>

@endsection