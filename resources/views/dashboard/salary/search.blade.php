@extends('dashboard.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('Design/css/salary/main.css')}}">
@endpush
@section('title','المرتبات')

@section('body')
<div class="body">
    <div class="search-salary-container">

        <div class="search-salary-head">

            <a class="btn btn-info" href="{{route('dashboard.salary.index')}}">
                <i style="vertical-align: middle" class="fa-solid fa-backward"></i>
                رجوع
            </a>

            <h5>البيانات الاساسيه للموظف </h5>
        </div>


        <div class="search-salary-content">
            <div class="show-users">

                <div class="main-body">



                    <div class="col mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                @if($CheckUserState->gender=='male')
                                <img src="{{asset(env('App_Design_Url').'/Design/images/male.png')}}" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                                @else
                                <img src="{{asset(env('App_Design_Url').'/Design/images/female.png')}}" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">

                                @endif
                                <h5 class="card-title">أسم الموظف : {{$CheckUserState->name}}</h5>
                                <p class="text-secondary mb-1"> الفرع : {{$CheckUserState->branch->name}}</p>

                                <div class="emp-details">
                                    @if($CheckUserState->salary_system == 'basic')
                                    <p>نظام المرتب : مرتب شهري </p>
                                    <p>المرتب الاساسي : {{$CheckUserState->salary}}</p>
                                    @elseif($CheckUserState->salary_system == 'basic_and_commotion')
                                    <p>نظام المرتب : مرتب شهري + عموله </p>
                                    <p>المرتب الاساسي : {{$CheckUserState->salary}}</p>
                                    <p>نسبة العموله : {{$CheckUserState->commotion}}%</p>
                                    @else
                                    <p>نظام المرتب : بالعموله </p>
                                    <p>نسبة العموله : {{$CheckUserState->commotion}}% </p>
                                    @endif
                                    <h5>الاجر المستحق : ({{$Result}}) جنيها </h5>
                                </div>


                            </div>
                        </div>


                    </div>
                </div>

            </div>





            @if($CheckUserState->salary_system != 'commotion')
            <h3 class="emp-details-table-title">تفاصيل حضور وانصراف الموظف</h3>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">التاريخ</th>
                        <th scope="col">وقت الحضور</th>
                        <th scope="col"> وقت الانصراف</th>
                        <th scope="col"> ساعات العمل الفعليه </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($SalaryData as $UserSalary)
                    <tr>
                        <td>{{\Carbon\Carbon::parse($UserSalary->created_at)->format('d-m-Y')}}</td>
                        <td>{{\Carbon\Carbon::parse($UserSalary->check_in)->format('h:i:s')}}</td>
                        <td>{{\Carbon\Carbon::parse($UserSalary->check_out)->format('h:i:s')}}</td>
                        <td>{{$UserSalary->duration}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

        </div>
    </div>
</div>
@endsection