@extends('dashboard.layouts.app')
@section('title', 'أفريكانا' . ' || ' . 'التقارير')

@section('body')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded">
        <div class="card-body">
            <h2 class="text-center mb-4 text-primary">إنشاء التقارير</h2>

            <form action="{{ route('reports.generate') }}" method="GET">
                <div class="row">
                    <!-- Start Date -->
                    <div class="col-md-6 mb-3">
                        <label for="start_date" class="form-label">بداية من تاريخ</label>
                        <input type="date" name="start_date" id="start_date" class="form-control form-control-lg shadow-sm" required>
                    </div>

                    <!-- End Date -->
                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label">أنتهاء الي تاريخ</label>
                        <input type="date" name="end_date" id="end_date" class="form-control form-control-lg shadow-sm" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm mt-3">انشاء تقرير</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* General Container Styling */
    .container {
        max-width: 800px;
        margin-top: 5rem;
    }

    /* Card Styling */
    .card {
        border-radius: 20px;
        background: linear-gradient(135deg, #007bff, #00d2d2);
        color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .card-body {
        padding: 3rem;
    }

    /* Heading Styling */
    h2 {
        font-size: 2rem;
        font-weight: 700;
    }

    /* Input Fields */
    .form-control {
        border-radius: 10px;
        background-color: #f4f4f4;
        border: 1px solid #ddd;
        font-size: 1rem;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
        border-color: #2691ff;
    }

    /* Buttons */
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 12px;
        border-radius: 10px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    /* Shadows and hover effects */
    .shadow-sm {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    }

    .shadow-sm:hover {
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.18), 0 4px 10px rgba(0, 0, 0, 0.24);
    }
</style>
@endsection