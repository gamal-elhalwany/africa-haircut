@extends('dashboard.layouts.app')
<link rel="stylesheet" href="{{asset('Design/css/users/main.css')}}">
@section('title','إدارة المستخدمين')

@section('body')
    <div class="body">

            <div class="show-users-head-content">

                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('dashboard.users.create') }}"> انشاء مستخدم جديد</a>
                </div>
            </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif



        <div class="show-users">

                <div class="main-body">


                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 gutters-sm">
                        @foreach ($data as $key => $user)
                             <div class="col mb-3">
                                <div class="card">
                                    <img src="{{asset('Design/images/u_cover.png')}}" alt="Cover" class="card-img-top">
                                        <div class="card-body text-center">
                                            @if($user->gender=="male")
                                            <img src="{{asset('Design/images/male.png')}}" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                                            @else
                                             <img src="{{asset('Design/images/female.png')}}" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                                            @endif
                                            <h5 class="card-title">{{$user->name}}</h5>
                                            <p class="text-secondary mb-1">Full Stack Developer</p>
                                            <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                                        </div>
                                    <div class="card-footer">
                                        <a class="btn btn-info" href="{{ route('dashboard.users.show',$user->id) }}"><i class="fa-regular fa-eye"></i></a>
                                        <a class="btn btn-primary" href="{{ route('dashboard.users.edit',$user->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <form action="{{route('dashboard.users.destroy', $user->id)}}" method="POST" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

        </div>


{{--        <table class="table table-bordered">--}}
{{--            <tr>--}}
{{--                <th>الاسم</th>--}}
{{--                <th>البريد</th>--}}
{{--                <th>الصلاحيه</th>--}}
{{--                <th>تحكم</th>--}}
{{--            </tr>--}}
{{--            @foreach ($data as $key => $user)--}}
{{--                <tr>--}}
{{--                    <td>{{ $user->name }}</td>--}}
{{--                    <td>{{ $user->email }}</td>--}}
{{--                    <td>--}}
{{--                        @if(!empty($user->getRoleNames()))--}}
{{--                            @foreach($user->getRoleNames() as $v)--}}
{{--                                {{ $v }}--}}
{{--                            @endforeach--}}
{{--                        @endif--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <a class="btn btn-info" href="{{ route('dashboard.users.show',$user->id) }}"><i class="fa-regular fa-eye"></i></a>--}}
{{--                        <a class="btn btn-primary" href="{{ route('dashboard.users.edit',$user->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>--}}
{{--                        <form action="{{route('dashboard.users.destroy', $user->id)}}" method="POST" style="display: inline">--}}
{{--                            @csrf--}}
{{--                            @method('DELETE')--}}
{{--                            <button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i></button>--}}
{{--                        </form>--}}
{{--                        {!! Form::open(['method' => 'DELETE','route' => ['dashboard.users.destroy', $user->id],'style'=>'display:inline']) !!}--}}
{{--                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}--}}
{{--                        {!! Form::close() !!}--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--        </table>--}}

{{--        {!! $data->render() !!}--}}
    </div>
@endsection
