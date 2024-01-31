@extends('dashboard.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{asset('Design/css/roles/main.css')}}">
@endpush
@section('title','عرض الصلاحية')
@section('body')
    <div class="body">

            <div class="show-role-container">
                <div class="show-role-head">
                    <a class="btn btn-info" href="{{route('dashboard.roles.index')}}">
                        <i style="vertical-align: middle" class="fa-solid fa-backward"></i>
                        رجوع
                    </a>
                    <h5> عرض الصلاحية</h5>


                </div>


                <div class="show-role-content">
                    <div class="role-name">
                        <strong>أسم الصلاحية : </strong>
                        {{ $role->name }}
                    </div>
                    <div class="text">
                        <h4>التحكمات : </h4>
                    </div>
                    <div class="role-permissions">

                        @if(!empty($rolePermissions))
                            @foreach($rolePermissions as $v)
                                <label class="label label-success">{{ $v->name }},</label>
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>


    </div>
@endsection
