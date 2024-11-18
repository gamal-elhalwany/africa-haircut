@extends('dashboard.layouts.app')
@section('title', 'أفريكانا' . ' || ' . 'النفقات')

@section('body')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded">
        <div class="card-body">
            <h1 class="text-center mb-4 display-5 text-primary">النفقات</h1>

            <table class="table table-hover table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>التاريخ</th>
                        <th>النوع</th>
                        <th>المبلغ</th>
                        <th>الوصف</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenses as $expense)
                    <tr>
                        <td>{{ $expense->date }}</td>
                        <td>{{ $expense->category }}</td>
                        <td class="text-success">{{ number_format($expense->amount) }} £</td>
                        <td>{{ $expense->description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-4">
                {{ $expenses->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<style>
    .card-body {
        background: #f9f9f9;
        padding: 30px;
        border-radius: 15px;
    }

    .table thead th {
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .table tbody tr:hover {
        background-color: #f0f8ff;
        transition: background-color 0.3s ease-in-out;
    }

    .table tbody td {
        font-size: 0.95rem;
        vertical-align: middle;
    }

    .pagination {
        font-size: 1rem;
    }
</style>
@endpush