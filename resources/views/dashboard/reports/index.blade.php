@extends('dashboard.layouts.app')
@section('title', 'أفريكانا' . ' || ' . 'التقارير')

@section('body')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded">
        <div class="card-body">
            <h2 class="text-center mb-4 display-6 text-primary">إنشاء التقارير</h2>

            <form method="POST" action="{{ route('reports.generate') }}" class="needs-validation" novalidate>
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="start_date" class="form-label">بداً من تاريخ:</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" required>
                        <div class="invalid-feedback">يرجي اختيار تاريخ البداية.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="end_date" class="form-label">حتي تاريخ:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" required>
                        <div class="invalid-feedback">يرجي اختيار تاريخ النهاية.</div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4 py-2">انشاء تقرير</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('style')
<style>
    body {
        text-align: right;
    }
    .card-body {
        background: #ffffff;
        padding: 40px;
        border-radius: 15px;
    }

    form .form-control {
        border-radius: 8px;
        padding: 10px;
        font-size: 1rem;
    }

    form label {
        font-weight: bold;
        color: #555;
    }

    form button {
        font-size: 1.1rem;
        transition: background-color 0.3s ease-in-out;
    }

    form button:hover {
        background-color: #004085;
    }
</style>
@endpush