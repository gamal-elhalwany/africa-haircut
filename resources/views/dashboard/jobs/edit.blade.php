@extends('dashboard.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{asset(env('App_Design_Url').'/Design/css/jobs/main.css')}}">
@endpush
@section('title','إضافة مستخدم جديد')

@section('body')
    <div class="body">
        <div class="edit-job-container">

            <div class="edit-job-head">
                <a class="btn btn-info" href="{{route('dashboard.chairs.index')}}">
                    <i style="vertical-align: middle" class="fa-solid fa-backward"></i>
                    رجوع
                </a>
                <h5> انشاء وظيفه جديده </h5>
            </div>

            <div class="edit-job-content">
                <form action="{{route('dashboard.jobs.update',$GetJobById)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="input-style">
                        <input type="text" name="name" class="form-control" value="{{$GetJobById->name}}" placeholder="أسم الوظيفه">
                    </div>
                    <div class="input-style">
                        <button class="btn btn-primary">تعديل الأن</button>
                    </div>
                </form>
            </div>


            </div>


    </div>
@endsection
