@extends('dashboard.layouts.app')
@section('title', 'Report Results')

@section('body')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded">
        <div class="card-body">
            <!-- Report Title -->
            <h2 class="text-center text-primary mb-4">تقرير من {{ $startDate->toDateString() }} الي {{ $endDate->toDateString() }}</h2>

            <!-- Total Revenue -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4>إجمالي الإيرادات: {{ number_format($totalRevenue, 2) }} </h4>
            </div>

            <!-- Daily Transactions -->
            <div class="mt-4">
                <h5 class="text-secondary mb-3">المعاملات اليومية</h5>
                @foreach($dailyTransactions as $date => $transactions)
                <div class="mb-4">
                    <h6 class="text-info">{{ $date }}</h6>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>رقم الفاتورة</th>
                                    <th>العميل</th>
                                    <th>إجمالي التكلفة</th>
                                    <th>التاريخ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->customer->name }}</td>
                                    <td>{{ number_format($invoice->total_cost, 2) }}</td>
                                    <td>{{ $invoice->created_at->toDateTimeString() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* General Styling for the container */
    .container {
        direction: rtl;
        max-width: 900px;
        margin-top: 3rem;
    }

    /* Card Styling */
    .card {
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .card-body {
        padding: 2rem;
    }

    /* Heading Styles */
    h2 {
        text-align: right;
        font-size: 2.2rem;
        font-weight: 700;
        color: #007bff;
    }

    h4, h5 {
        text-align: right;
        font-size: 1.25rem;
        color: #333;
    }

    h6 {
        font-size: 1.1rem;
        color: #17a2b8;
    }

    /* Table Styling */
    table {
        direction: rtl;
        width: 100%;
        border-collapse: collapse;
    }

    table th, table td {
        direction: rtl;
        text-align: center;
        padding: 10px;
        font-size: 1rem;
    }

    table th {
        background-color: #007bff;
        color: white;
    }

    table td {
        background-color: #f9f9f9;
    }

    /* Table Hover Effect */
    table tbody tr:hover {
        background-color: #e9ecef;
    }

    /* Button Styling */
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 10px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    /* Responsive Styling */
    @media (max-width: 767px) {
        .container {
            padding-left: 10px;
            padding-right: 10px;
        }
    }
</style>
@endsection