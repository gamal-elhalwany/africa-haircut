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
                        <!-- <h6><span style="color: orange">الفرع التابع : </span> {{auth()->user()->branch->name}}</h6>-->
                        @if($Available->count() > 0)
                        <div class="alert alert-secondary" role="alert">
                            الكراسي المتاحه
                        </div>

                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if(session('error'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if(isset($lowStockAlert) && $lowStockAlert)
                        <div class="alert alert-warning">
                            <strong>تحذير! </strong>بعض المنتجات قد وصلت الي الحد الأدني من الكمية المخزونة:
                            <ul>
                                @foreach($lowStockProducts as $product)
                                <li>{{$loop->iteration }} - {{ $product->name }} - فقط {{ $product->quantity }} المتبقي من المخزون!</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @foreach($Available as $AvailableChairs)
                        <li class="manager-item">
                            <img src="{{asset('Design/images/available.png')}}">
                            <p>
                            <h5>الدور : {{$AvailableChairs->floor}} </h5>
                            @if($AvailableChairs->user)
                            <h5> الموظف : {{$AvailableChairs->user->name}} </h5>
                            @endif

                            <h5>رقم الكرسي: {{$AvailableChairs->number}}</h5>
                            </p>

                            @if($AvailableChairs->user)
                            <form action="{{route('open.chair',$AvailableChairs->id)}}" method="POST">
                                @csrf
                                @if($AvailableChairs->number !== 0)
                                <button class="btn btn-info"> حجز</button>
                                @endif
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


                <!-- END MANAGER CONTENT-->


                <!-- START BRANCH USERS -->
                <div class="branch-user-container">
                    <div class="branch-user-content">
                        <div style="text-align: center" class="alert alert-dark" role="alert">
                            حضور وانصراف الموظفين
                        </div>
                        <ul>
                            @foreach($users as $user)
                            <li>
                                <div>
                                    <b>
                                        اسم الموظف :
                                    </b>
                                    {{$user->name}}
                                </div>
                                <div>
                                    <b>
                                        ساعات العمل المطلوبه :
                                    </b>
                                    {{$user->work_hours}}
                                </div>
                                <div>
                                    <form action="{{route('daily', $user->id)}}" method="POST">
                                        @csrf
                                        <div>
                                            @if($user->chair)
                                            <p>
                                                رقم الكرسي ({{$user->chair->number }})
                                                الدور ({{$user->chair->floor}})
                                            </p>
                                            @endif
                                            @if(!$user->chair || !$user->daily)
                                            <select class="form-control" name="chair_id">
                                                @foreach($Available as $AvailableChair)
                                                @if($AvailableChair->user_id == null)
                                                <option value="{{$AvailableChair->id}}">
                                                    الكرسي: {{$AvailableChair->number}} -
                                                    الدور: {{$AvailableChair->floor}}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @endif
                                        </div>
                                        <div>
                                            @if($user->chair)
                                            <input type="submit" class="btn btn-dark" name="checkOut" value="انصراف">
                                            @else
                                            <input type="submit" class="btn btn-info" name="checkIn" value="حضور">
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- END BRANCH USERS -->
                @endif
            </div>
        </div>
    </div>
</div>
@endsection