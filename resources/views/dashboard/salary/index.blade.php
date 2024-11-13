@extends('dashboard.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{asset('Design/css/salary/main.css')}}">
@endpush
@section('title','المرتبات')

@section('body')
    <div class="body">
            <div class="salary-container">

                    <div class="salary-head">
                        <a class="btn btn-info" href="{{route('dashboard.index')}}">
                            <i style="vertical-align: middle" class="fa-solid fa-backward"></i>
                            الرئيسية
                        </a>

                        <h5>مرتبات الموظفين</h5>
                    </div>


                    <div class="salary-content">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                     <form action="{{route('salary.search')}}" method="POST">
                        @csrf

                         <label for="emp_name"> أسم الموظف </label>
                         <div class="input-style">
                            <select name="user" id="emp_name" class="form-control">
                                @foreach($AllUsers as $User)
                                    <option value="{{$User->id}}">{{$User->name}}</option>
                                @endforeach
                            </select>
                         </div>


                         <label for="month"> من تاريخ</label>
                         <div class="input-style">
                             <input type="date" id="date" name="start_date_time" class="form-control">
                         </div>


                         <label for="month"> إلى تاريخ</label>
                        <div class="input-style">
                            <input type="date" id="date" name="end_date_time" class="form-control">
                        </div>


                         <div class="input-style">
                            <button class="btn btn-info" type="submit">معرفة المرتب</button>
                         </div>
                     </form>

                    </div>
            </div>
        </div>
@endsection
