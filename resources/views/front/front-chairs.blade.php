@extends('layout/header')
@section('title', 'أفريكانا ' . '||' .' الكراسي')

@section('content')

<style>
    /* Global Styling */
    body {
        font-family: 'Cairo', sans-serif;
        background: linear-gradient(to bottom, #e3f2fd, #e1bee7);
        margin: 0;
        padding: 0;
    }

    .container {
        padding-top: 30px;
        padding-bottom: 30px;
    }

    h2 {
        font-size: 2.5rem;
        font-weight: bold;
        text-align: center;
        color: #fff;
        background: linear-gradient(45deg, #bb8c4b, #935028);
        padding: 15px;
        border-radius: 12px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    .row {
        margin-top: 20px;
    }

    /* Card Styling */
    .card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    .card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card-body {
        padding: 20px;
        text-align: center;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #283593;
        margin-bottom: 10px;
    }

    .card-text {
        font-size: 1rem;
        color: #616161;
        margin-bottom: 20px;
    }

    /* Form Styling */
    .form-control {
        border: none;
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 1rem;
        color: #333;
        background: #f5f5f5;
        box-shadow: inset 3px 3px 8px #d1d1d1, inset -3px -3px 8px #ffffff;
        transition: all 0.2s ease-in-out;
    }

    .form-control:focus {
        outline: none;
        box-shadow: 0 0 5px rgba(103, 58, 183, 0.8);
    }

    .btn-primary {
        background: linear-gradient(45deg, #bb8c4b, #935028);
        color: #fff;
        font-weight: bold;
        border: none;
        border-radius: 30px;
        padding: 12px 20px;
        font-size: 1rem;
        transition: all 0.3s ease-in-out;
    }

    .btn-primary:hover {
        transform: translateY(-5px);
        background: linear-gradient(180deg, #bb8c4b, #935028);
    }

    .alert {
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
</style>

<button class="scroll-top" id="scroll-top">
    <i class="fas fa-angle-double-up"></i>
</button>
<div class="container">
    <h2>الكراسي المتاحة</h2>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <strong>{{ session('error') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        @if($chairs->count() > 0)
        @foreach($chairs as $chair)
        <div class="col-lg-6 col-md-4 col-sm-6">
            <div class="card">
                <img src="https://l.top4top.io/p_26550dd1k1.jpg" alt="Chair Image" style="float: left;">
                <div class="card-body" style="text-align: right;">
                    <h5 class="card-title">كرسي: {{$chair->number}}</h5>
                    <p class="card-text">الدور: {{$chair->floor}}</p>
                    <p class="card-text">فرع: {{$chair->branch->name}}</p>

                    <form action="{{ route('store.appointment') }}" method="POST">
                        @csrf
                        <div class="mb-3 ml-1" style="width: 48%; float:right;">
                            <input type="text" name="customer_name" class="form-control" placeholder="الأسم" required>
                            @error('customer_name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 mr-1" style="width: 48%; float:left;">
                            <input type="text" name="mobile" class="form-control" placeholder="رقم الموبايل" required>
                            @error('mobile')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <input type="hidden" name="chair_id" value="{{$chair->id}}">
                        <input type="hidden" name="branch_id" value="{{$chair->branch->id}}">

                        <div class="mb-3 ml-1" style="width: 48%; float:right;">
                            <input type="date" name="appointment_date" class="form-control" min="{{ now()->toDateString() }}" required>
                            @error('appointment_date')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 mr-1" style="width: 48%; float:left;">
                            <input type="time" name="start_at" class="form-control" required>
                            @error('start_at')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">احجز موعداً الآن</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <p class="text-center mt-5 text-muted">لا توجد كراسي متاحة حالياً.</p>
        @endif
    </div>
</div>

@endsection