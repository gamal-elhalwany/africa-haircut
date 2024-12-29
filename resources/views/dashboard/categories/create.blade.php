@extends('dashboard.layouts.app')

@push('style')
<link rel="stylesheet" href="{{asset('Design/css/salary/main.css')}}">
<style>
    .body {
        font-family: 'Cairo', sans-serif;
        direction: rtl;
        background-color: #f4f6f9;
        padding: 20px;
    }

    /* Salary container */
    .salary-container {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Header */
    .salary-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .salary-head h5 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
    }

    .salary-head a {
        font-size: 16px;
        display: inline-flex;
        align-items: center;
        color: #ffffff;
        padding: 8px 20px;
        background-color: #17a2b8;
        border-radius: 30px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .salary-head a:hover {
        background-color: #138496;
    }

    .salary-head i {
        margin-left: 5px;
    }

    /* Content */
    .salary-content {
        margin-top: 30px;
    }

    .salary-content form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .input-style {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .input-style select,
    .input-style input,
    .input-style button {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .input-style button {
        background-color: #17a2b8;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .input-style button:hover {
        background-color: #138496;
    }

    /* Error messages */
    ul {
        padding: 0;
        margin: 10px 0;
        list-style: none;
    }

    ul li {
        color: #721c24;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
    }
</style>
@endpush

@section('title','افريقيا' . ' || ' . 'انشاء فئة')

@section('body')
<div class="body">
    <div class="salary-container">
        <div class="salary-head">
            <a class="btn btn-info" href="{{route('dashboard.index')}}">
                <i class="fa-solid fa-backward"></i>
                الرئيسية
            </a>

            <h5>فئات المنتجات والخدمات</h5>
        </div>

        <div class="salary-content">
            <!-- Display error messages -->
            @if($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif

            <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="input-style">
                    <label for="emp_name">أسم الفئة:</label>
                    <input type="text" name="name" placeholder="ادخل اسم الفئة">
                    @error('category')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-style">
                    <label for="parent_id"> الفئة الرئيسية:</label>
                    <select type="text" id="text" name="parent_id" class="form-control">
                        <option value="">اختر الفئة الرئيسية</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('parent_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-style">
                    <label for="dexcription">الوصف:</label>
                    <input type="text" id="description" name="description" class="form-control">
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-style">
                    <label for="image">الصورة:</label>
                    <input type="file" id="image" name="image" class="form-control">
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-style">
                    <button class="btn btn-info" type="submit">انشاء فئة</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection