@extends('dashboard.layouts.app')
@section('title', 'أفريكانا' . ' || ' . 'اضافة النفقات')

@section('body')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-md border-0 rounded">
                <div class="card-body">
                    <h2 class="text-center mb-4 display-6 text-primary">إضافة نفقات</h2>

                    <form method="POST" action="{{ route('expenses.store') }}" class="needs-validation" style="text-align: right;">
                        @csrf
                        <div class="mb-3">
                            <label for="date" class="form-label">التاريخ:</label>
                            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" >
                            @error('date')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">الفئة:</label>
                            <input type="text" name="category" id="category" class="form-control @error('category') is-invalid @enderror" placeholder="مثال: سفر، طعام، سلفة">
                            @error('category')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">الموظف(أختيارى):</label>
                            <select type="text" name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" placeholder="اسم الموظف">
                                <option>اسم الموظف</option>
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">المبلغ:</label>
                            <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" step="0.01" placeholder="0.00">
                            @error('amount')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">الوصف (اختياري):</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="أضف ملاحظات..."></textarea>
                            @error('description')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-4 py-2">إضافة النفقات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<style>
    .card-body {
        background: #ffffff;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    form label {
        font-weight: bold;
        color: #333;
    }

    form .form-control {
        border-radius: 8px;
        padding: 10px;
        font-size: 1rem;
    }

    form textarea {
        resize: none;
    }

    form button {
        font-size: 1.1rem;
        transition: background-color 0.3s ease-in-out;
    }

    form button:hover {
        background-color: #004085;
        /* Darker blue */
    }
</style>
@endpush