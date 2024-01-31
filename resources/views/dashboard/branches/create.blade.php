@extends('dashboard.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{asset('Design/css/branches/main.css')}}">
@endpush
@section('title','اضافة فرع جديد')

@section('body')
    <div class="body">
        <div class="create-branch-container">

            <div class="create-branch-head">
                <a class="btn btn-info" href="{{route('dashboard.branches.index')}}">
                    <i style="vertical-align: middle" class="fa-solid fa-backward"></i>
                    رجوع
                </a>
            </div>

            <div class="create-branch-content">
                <div class="create-branch">
                    <form action="{{route('dashboard.branches.store')}}" method="POST">
                        @csrf

                        <div class="input-style">
                            <input type="text" class="form-control" name="branch_name" placeholder="أسم الفرع">
                        </div>

                        <div class="input-style">
                            <button class="btn btn-success">إضاف الأن</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
