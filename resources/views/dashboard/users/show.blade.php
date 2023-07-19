@extends('dashboard.layouts.app')
<link rel="stylesheet" href="{{asset(env('App_Design_Url').'/Design/css/users/main.css')}}">

@section('title',$user->name)
@section('body')
    <div class="body">


        <div class="show-user-container">
            <div class="show-user-header">
                <a class="btn btn-info" href="{{ route('dashboard.users.index') }}">
                    <i style="vertical-align: middle" class="fa-solid fa-backward"></i>
                    رجوع
                </a>
            </div>
            <div class="show-user-content">

                <div class="show-user-card">

                  <ul class="show-user-list-items">

                          <li class="show-user-item avatar">
                              @if($user->gender=="male")
                                  <img src="{{asset(env('App_Design_Url').'/Design/images/male.png')}}" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                              @else
                                  <img src="{{asset(env('App_Design_Url').'/Design/images/female.png')}}" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                              @endif
                          </li>

                          <li class="show-user-item">
                              <i class="fa-solid fa-signature"></i>    {{$user->name}}
                          </li>
                          <li class="show-user-item">
                              @if($user->salary_system =='basic')
                                  <i class="fa-solid fa-money-bill"></i>   مرتب اساسي : {{$user->salary}}
                              @elseif($user->salary_system == 'commotion')
                                  <i class="fa-solid fa-money-bill"></i>  بالعمولة : {{$user->commotion}}%
                              @else
                                  <i class="fa-solid fa-money-bill"></i>  مرتب + عمولة : {{$user->salary}} +  {{$user->commotion}}%
                              @endif
                          </li>
                          <li class="show-user-item">
                              <i class="fa-solid fa-envelope"></i>    {{$user->email}}
                          </li>
                          <li class="show-user-item">

                          </li>
                          <li class="show-user-item">
                              @if(!empty($user->getRoleNames()))
                                  @foreach($user->getRoleNames() as $v)
                                      <i class="fa-solid fa-gear"></i>      <span>الصلاحيه : {{ $v }}</span>
                                  @endforeach
                              @endif
                          </li>
                  </ul>
                </div>

            </div>
        </div>


    </div>
@endsection
