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
            <h2 class="btn btn-success">جميع الحجورزات والمواعيد</h2>
        </div>
    </div>

    <div class="container">
        <!-- Filter Form -->
        <form action="{{route('reservations')}}" method="GET" class="mb-4">
            <div class="row">
                <!-- Date Filter -->
                <div class="col-md-2">
                    <label for="date">التاريخ</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}" min="{{ now()->toDateString() }}">
                </div>

                <!-- Chair Filter -->
                <div class="col-md-2">
                    <label for="chair_id">الكرسي</label>
                    <select name="chair_id" id="chair_id" class="form-control">
                        <option value="">الكراسي</option>
                        @foreach($chairs as $chair)
                        <option value="{{ $chair->id }}" {{ request('$chair->id') == $chair->id ? 'selected' : '' }}>{{ $chair->number }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Branch Filter -->
                <div class="col-md-3">
                    <label for="branch_id">الفرع</label>
                    <select name="branch_id" id="branch_id" class="form-control">
                        <option value="">الفروع</option>
                        @foreach($branchs as $branch)
                        <option value="{{ $branch->id }}" {{ request('$branch->id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Customer Filter -->
                <div class="col-md-2">
                    <label for="customer_name">العميل</label>
                    <input type="text" name="customer_name" class="form-control" placeholder="أسم العميل"/>
                </div>

                <!-- Submit Button -->
                <div class="col-md-2 align-self-end">
                    <button type="submit" class="btn btn-primary btn-block">بحث</button>
                </div>
            </div>
        </form>

        <!-- Appointments Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>العميل</th>
                    <th>رقم الكرسي</th>
                    <th>التاريخ</th>
                    <th>موعد الحجز</th>
                    <th>أنتهاء الموعد</th>
                    <th>حالة الحجز</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->customer_name }}</td>
                    <td>{{ $reservation->chair_id }}</td>
                    <td>{{ $reservation->appointment_date }}</td>
                    <td>{{ $reservation->start_at }}</td>
                    <td>{{ $reservation->end_at }}</td>
                    <td>{{ $reservation->status }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">لا يوجد اي كراسي محجوزة.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $reservations->links() }}
        </div>
    </div>
    @endsection