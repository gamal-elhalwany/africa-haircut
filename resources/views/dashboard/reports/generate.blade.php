@extends('dashboard.layouts.app')
@section('title', 'أفريكانا' . ' || ' . 'نتيجة التقرير')

@section('body')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded">
        <div class="card-body" style="text-align: right;">
            <h1 class="text-center text-primary mb-4 display-6">تقرير الربح & الخسارة</h1>

            <h2 class="text-secondary mb-3">ملخص</h2>
            <table class="table table-bordered text-center">
                <tr class="table-primary">
                    <th>إجمالي الإيرادات</th>
                    <td class="text-success">{{ number_format($totalRevenue) }} £</td>
                </tr>
                <tr class="table-warning">
                    <th>إجمالي النفقات</th>
                    <td class="text-danger">{{ number_format($totalExpenses) }} £</td>
                </tr>
                <tr class="{{ $profitOrLoss >= 0 ? 'table-success' : 'table-danger' }}">
                    <th>الربح/الخسارة</th>
                    <td>{{ number_format($profitOrLoss) }} £</td>
                </tr>
            </table>

            <h2 class="text-secondary mt-4 mb-3">التقرير النهائي</h2>

            <h3 class="text-info mb-2">الإيرادات</h3>
            <table class="table table-striped table-hover text-center">
                <thead class="table-light">
                    <tr>
                        <th>التاريخ</th>
                        <th>إجمالي الإيراد</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dailyTransactions as $date => $transactions)
                    <tr>
                        <td>{{ $date }}</td>
                        <td class="text-success">{{ number_format($transactions->sum('total_cost')) }} £</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <h3 class="text-info mt-4 mb-2">النفقات</h3>
            <table class="table table-striped table-hover text-center">
                <thead class="table-light">
                    <tr>
                        <th>التاريخ</th>
                        <th>إجمالي النفقات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dailyExpenses as $date => $expenses)
                    <tr>
                        <td>{{ $date }}</td>
                        <td class="text-danger">{{ number_format($expenses->sum('amount')) }} £</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-center mt-4">
                <a href="{{ route('reports.index') }}" class="btn btn-secondary px-4 py-2">العودة</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<style>
    .card-body {
        background: #f9f9f9;
        padding: 40px;
        border-radius: 15px;
    }

    .table th,
    .table td {
        font-size: 1rem;
        padding: 10px;
        vertical-align: middle;
    }

    .table-hover tbody tr:hover {
        background-color: #f0f8ff;
    }

    h1,
    h2,
    h3 {
        font-weight: bold;
    }
</style>
@endpush