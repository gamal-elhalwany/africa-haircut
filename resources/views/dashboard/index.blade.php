@extends('dashboard.layouts.app')

@section('title', 'الرئيسية')

@section('body')
<div class="container mt-4">
    <div class="dashboard-container">
        <div class="dashboard-header text-center mb-4">
            <h1 class="text-primary">لوحة التحكم الرئيسية</h1>
        </div>

        @if(auth()->user()->branch_id)
        <!-- Manager Content -->
        <div class="manager-content">
            <div class="section">
                <h3 class="text-secondary mb-3">الكراسي المتاحة</h3>

                @if($Available->count() > 0)
                <div class="alert alert-info text-center">الكراسي المتاحة حالياً</div>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(isset($lowStockAlert) && $lowStockAlert)
                <div class="alert alert-warning text-center">
                    <strong>تحذير!</strong> بعض المنتجات وصلت إلى الحد الأدنى:
                    <ul style="list-style: none;">
                        @foreach($lowStockProducts as $product)
                        <li>{{ $loop->iteration }} - {{ $product->name }}: فقط {{ $product->quantity }} المتبقي!</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="row g-3">
                    @foreach($Available as $AvailableChairs)
                    <div class="col-md-4">
                        <div class="card text-center" style="padding: 30px;">
                            <img src="{{ asset('Design/images/available.png') }}" class="card-img-top" alt="Available Chair">
                            <div class="card-body">
                                <h5 class="card-title">الدور: {{ $AvailableChairs->floor }}</h5>
                                @if($AvailableChairs->user)
                                <p>الموظف: {{ $AvailableChairs->user->name }}</p>
                                @endif
                                <p>رقم الكرسي: {{ $AvailableChairs->number }}</p>
                                @if($AvailableChairs->user)
                                <form action="{{ route('open.chair', $AvailableChairs->id) }}" method="POST">
                                    @csrf
                                    @if($AvailableChairs->number !== 0)
                                    <button class="btn btn-info"> حجز</button>
                                    @else
                                    <button class="btn btn-dark" disabled>الكاشير</button>
                                    @endif
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="alert alert-warning">لا يوجد كراسي متاحة حالياً.</div>
                @endif
            </div>

            <!-- Busy Chairs Section -->
            @if($Busy->count())
            <div class="section mt-5">
                <h3 class="text-secondary mb-3">الكراسي المحجوزة</h3>
                <div class="row g-3">
                    @foreach($Busy as $BusyChairs)
                    <div class="col-md-4">
                        <div class="card text-center" style="padding: 30px;">
                            <img src="{{ env('App_Design_Url') . '/Design/images/busy.png' }}" class="card-img-top" alt="Busy Chair">
                            <div class="card-body">
                                <h5 class="card-title">الدور: {{ $BusyChairs->floor }}</h5>
                                @if($BusyChairs->user)
                                <p>الموظف: {{ $BusyChairs->user->name }}</p>
                                @endif
                                <p>رقم الكرسي: {{ $BusyChairs->number }}</p>
                                <a href="{{ route('open.invoice', $BusyChairs->id) }}" class="btn btn-warning">فتح فاتورة</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Branch Users Section -->
        <div class="branch-users mt-5">
            <h3 class="text-secondary text-center mb-3">حضور وانصراف الموظفين</h3>
            <div class="row g-3">
                @foreach($users as $user)
                <div class="col-md-4">
                    <div class="card p-3">
                    <?php $date = now()->toDateString(); ?>
                        <h5>اسم الموظف: {{ $user->name }}</h5>
                        <p>ساعات العمل المطلوبة: {{ $user->work_hours }}</p>
                        @if(!$user->chair && App\Models\Daily::where('user_id', $user->id)->where('date', $date)->where('status', 'حضور')->first())
                        <form action="{{route('chairs.assign', $user->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            @if($user->chair)
                            <p>رقم الكرسي: {{ $user->chair->number }}, الدور: {{ $user->chair->floor }}</p>
                            @endif
                            @if(!$user->chair || !$user->daily)
                            <select class="form-control mb-3" name="chair_id">
                                @foreach($Available as $AvailableChair)
                                @if($AvailableChair->user_id == null)
                                <option value="{{ $AvailableChair->id }}">الكرسي: {{ $AvailableChair->number }} - الدور: {{ $AvailableChair->floor }}</option>
                                @endif
                                @endforeach
                            </select>
                            @endif
                            <button type="submit" class="btn btn-outline-dark float-left">تعيين إلى كرسي</button>
                        </form>
                        @endif
                        <form action="{{ route('daily', $user->id) }}" method="POST">
                            @csrf

                            @if(App\Models\Daily::where('user_id', $user->id)->where('date', $date)->where('status', 'حضور')->first())
                            <button type="submit" class="btn btn-danger" name="action" value="checkOut">أنصراف</button>
                            @else
                            <button type="submit" class="btn btn-success" name="action" value="checkIn">حضور</button>
                            @endif
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection