@extends('dashboard.layouts.app')

@section('title','الرئيسيه')

@section('body')
<div class="body">
    <div class="index-dashboard-container">
        <div class="index-dashboard-content">
            <div class="index-dashboard">
                <!-- START MANAGER CONTENT -->
                @if(auth()->user()->branch_id)
                <div class="manager-content">
                    <ul class="manager-list-items">
                        {{-- <h6><span style="color: orange">الفرع التابع : </span> {{auth()->user()->branch->name}}</h6>--}}
                        @if($Available->count() > 0)
                        <div class="alert alert-primary" role="alert">
                            الكراسي المتاحه
                        </div>

                        @foreach($Available as $AvailableChairs)
                        <li class="manager-item">
                            <img src="{{asset('Design/images/available.png')}}">
                            <p>
                            <h5>الدور : {{$AvailableChairs->floor}} </h5>
                            @if($AvailableChairs->user)
                            <h5> الموظف : {{$AvailableChairs->user->name}} </h5>
                            @endif

                            <h5>رقم : {{$AvailableChairs->number}}</h5>
                            </p>

                            @if($AvailableChairs->user)
                            <form action="{{route('open.chair',$AvailableChairs->id)}}" method="POST">
                                @csrf
                                <button class="btn btn-info"> حجز</button>
                            </form>
                            @endif
                        </li>
                        @endforeach
                        @else

                        <div class="alert alert-warning" role="alert">
                            لا يوجد كراسي متاحه
                        </div>
                        @endif
                    </ul>
                    <hr>
                    @if($Busy->count())
                    <ul class="manager-list-items">
                        <div class="alert alert-secondary" role="alert">
                            الكراسي المحجوزه
                        </div>
                        @foreach($Busy as $BusyChairs)
                        <li class="manager-item busy">
                            <img src="{{env('App_Design_Url').'/Design/images/busy.png'}}">
                            <p>
                            <h5>الدور : {{$BusyChairs->floor}}</h5>
                            @if($BusyChairs->user)
                            <h5>الموظف : {{$BusyChairs->user->name}}</h5>
                            @endif
                            <h5>الرقم : {{$BusyChairs->number}}</h5>
                            </p>

                            <a href="{{route('open.invoice',$BusyChairs->id)}}">
                                <button class="btn btn-info"> فتح فاتوره </button>
                            </a>

                        </li>
                        @endforeach
                    </ul>

                    @endif
                </div>


                {{-- END MANAGER CONTENT--}}


                {{-- START BRANCH USERS --}}
                <div class="branch-user-container">
                    <div class="branch-user-content">
                        <div style="text-align: center" class="alert alert-dark" role="alert">
                            حضور وانصراف الموظفين
                        </div>
                        <ul>
                            @foreach(auth()->user()->branch->users as $Branch)
                            <li>
                                <div>
                                    <b>
                                        اسم الموظف :
                                    </b>
                                    {{$Branch->name}}
                                </div>
                                <div>
                                    <b>
                                        ساعات العمل المطلوبه :
                                    </b>
                                    {{$Branch->work_hours}}
                                </div>
                                <div>
                                    <form action="{{route('daily',$Branch->id)}}" method="POST">
                                        @csrf
                                        <div>
                                            @if($Branch->chair)
                                            {{$Branch->chair->number }}- ( الدور ) - {{$Branch->chair->floor}}
                                            @else
                                            @if(auth()->user()->branch->chairs->count())
                                            <select name="chair_id">
                                                @foreach(auth()->user()->branch->chairs as $chair)
                                                <option value="{{$chair->id}}">{{$chair->number}} : الدور : {{$chair->floor}}</option>
                                                @endforeach
                                            </select>
                                            @endif
                                            @endif
                                        </div>

                                        <div>
                                            @if(!$Branch->chair)
                                            <input type="submit" class="btn btn-info" name="presence" value="حضور">
                                            @else
                                            <input type="submit" class="btn btn-dark" name="departure" value="انصراف">
                                            @endif
                                        </div>

                                        @csrf

                                    </form>

                                </div>
                            </li>

                            @endforeach
                        </ul>


















                        {{-- <table class="table">--}}
                        {{-- <thead class="thead-dark">--}}
                        {{-- <tr>--}}
                        {{-- --}}{{-- <th scope="col">الرقم الوظيفي</th>--}}
                        {{-- <th scope="col">اسم الموظف</th>--}}
                        {{-- <th scope="col">ساعات العمل الطلوبه</th>--}}
                        {{-- <th scope="col">الكراسي</th>--}}
                        {{-- <th scope="col"> تحكم </th>--}}
                        {{-- </tr>--}}
                        {{-- </thead>--}}
                        {{-- <tbody>--}}
                        {{-- @foreach(auth()->user()->branch->users as $Branch)--}}
                        {{-- <tr>--}}
                        {{-- <th>{{$Branch->emp_id}}</th>--}}
                        {{-- <th>{{$Branch->name}}</th>--}}
                        {{-- <th>{{$Branch->work_hours}}</th>--}}
                        {{-- <form action="{{route('daily',$Branch->id)}}" method="POST">--}}
                        {{-- @csrf--}}
                        {{-- <th>--}}

                        {{-- @if($Branch->chair)--}}
                        {{-- {{$Branch->chair->number }}- ( الدور ) - {{$Branch->chair->floor}}--}}
                        {{-- @else--}}
                        {{-- @if(auth()->user()->branch->chairs->count())--}}
                        {{-- <select name="chair_id">--}}
                        {{-- @foreach(auth()->user()->branch->chairs as $chair)--}}
                        {{-- <option value="{{$chair->id}}">{{$chair->number}} : الدور : {{$chair->floor}}</option>--}}
                        {{-- @endforeach--}}
                        {{-- </select>--}}
                        {{-- @endif--}}
                        {{-- @endif--}}
                        {{-- </th>--}}

                        {{-- <th>--}}
                        {{-- @if(!$Branch->chair)--}}
                        {{-- <input type="submit" class="btn btn-info" name="presence" value="حضور">--}}
                        {{-- @else--}}
                        {{-- <input type="submit" class="btn btn-dark" name="departure" value="انصراف">--}}
                        {{-- @endif--}}
                        {{-- </th>--}}

                        {{-- @csrf--}}

                        {{-- </form>--}}


                        {{-- </tr>--}}
                        {{-- @endforeach--}}
                        {{-- </tbody>--}}
                        {{-- </table>--}}






                    </div>
                </div>

                {{-- END BRANCH USERS --}}
























                {{-- START CASHER CONTENT--}}
                {{-- <div class="chairs-content">--}}
                {{-- <ul class="chairs-list-items">--}}
                {{-- <h3>{{auth()->user()->branch->name}}</h3>--}}
                {{-- @foreach(auth()->user()->branch->chairs as $chairs)--}}
                {{-- <li class="chairs-item">--}}
                {{-- <img src="https://l.top4top.io/p_26550dd1k1.jpg">--}}
                {{-- <p>--}}
                {{-- <h3>{{$chairs->number}}</h3>--}}
                {{-- </p>--}}
                {{-- <button class="btn btn-info">فتح فاتوره</button>--}}
                {{-- </li>--}}
                {{-- @endforeach--}}
                {{-- </ul>--}}
                {{-- </div>--}}
                {{-- END CASHER CONTENT--}}


                @endif

            </div>
        </div>
    </div>
</div>
@endsection