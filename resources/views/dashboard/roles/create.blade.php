@extends('dashboard.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{asset('Design/css/salary/main.css')}}">
@endpush
@section('title','إنشاء صلاحية جديدة')
@section('body')

    <div class="body">

        <div class="create-role-container container mt-5">

            <div class="create-role-head">
                <a class="btn btn-info mb-3" href="{{route('dashboard.roles.index')}}">
                    <i style="vertical-align: middle" class="fa-solid fa-backward"></i>
                    رجوع
                </a>
                <h4>انشاء صلاحية جديدة</h4>

            </div>
            <div class="create-role-content">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::open(array('route' => 'dashboard.roles.store','method'=>'POST')) !!}
                    <div class="input-style role-name m-4">
                        <strong>أسم الصلاحية:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                    <div class="input-style checkBox">
                        @foreach($permission as $value)
                            <label>
                                {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                {{ $value->name }}
                            </label>
                        @endforeach

                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">إنشاء</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            </div>

    </div>
@endsection
