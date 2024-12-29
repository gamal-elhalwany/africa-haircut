@extends('dashboard.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{asset(env('App_Design_Url').'/Design/css/jobs/main.css')}}">
@endpush
@section('title','إضافة وظيفة جديدة')

@section('body')
    <div class="body">
        <div class="create-job-container">

            <div class="create-job-head">
                <a class="btn btn-primary" href="{{ route('dashboard.jobs.index') }}"> رجوع</a>
                <h2> انشاء وظيفه جديده </h2>
            </div>


            <div class="create-job-content">
                <form action="{{route('dashboard.jobs.store')}}" method="POST">
                    @csrf
                    <div class="input-style">
                        <input type="text" name="name" class="form-control" placeholder="أسم الوظيفه">
                    </div>
                    <div class="input-style">
                        <button class="btn btn-success">إضافة الأن</button>
                    </div>
                </form>
            </div>


            </div>


    </div>
@endsection
