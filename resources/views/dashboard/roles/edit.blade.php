@extends('dashboard.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{asset(env('App_Design_Url').'/Design/css/roles/main.css')}}">
@endpush
@section('title','تعديل الصلاحية')
@section('body')
    <div class="body">

        <div class="edit-role-container">

            <div class="edit-role-head">


                <a class="btn btn-info" href="{{route('dashboard.roles.index')}}">
                    <i style="vertical-align: middle" class="fa-solid fa-backward"></i>
                    رجوع
                </a>

                <div class="pull-left">
                    <h4>تعديل الصلاحية</h4>
                </div>

            </div>


            <div class="edit-role-content">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="alert alert-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form action="{{route('dashboard.roles.update', $role->id)}}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="input-style role-name">
                        <strong>أسم الصلاحية:</strong>
                        <input type="text" name="name" class="form-control" placeholder="أسم الصلاحية " value="{{$role->name}}">
                    </div>
                    <div class="input-style checkBox">
                        @foreach($permission as $value)
                            <label>
                                {{ $value->name }}
                                {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                            </label>

                        @endforeach
                    </div>
                    <div class="input-style">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">تعديل</button>
                        </div>
                    </div>



                </form>

            </div>
        </div>

    </div>


@endsection
