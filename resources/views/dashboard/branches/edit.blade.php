@extends('dashboard.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{asset('Design/css/branches/main.css')}}">
@endpush
@section('title','تعديل الفرع ')

@section('body')
    <div class="body">
        <div class="edit-branch-container">

            <div class="edit-branch-head">

                <a class="btn btn-info" href="{{route('dashboard.branches.index')}}">
                    <i style="vertical-align: middle" class="fa-solid fa-backward"></i>
                    رجوع
                </a>

            </div>

            <div class="edit-branch-content">
                @foreach($BranchID as $Branch)
                <div class="edit-branch">
                    <p><span> أسم الفرع الحالي : </span> {{$Branch->name}}</p>
{{--                    <p><span>الكاشير الحالي : </span> {{$Branch->user->name}}</p>--}}
                    <form action="{{route('dashboard.branches.update',$Branch->id)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="input-style">
                            <input type="text" class="form-control" name="branch_name" value="{{$Branch->name}}" placeholder="أسم الفرع">
                        </div>


                        <div class="input-style">
{{--                            <select name="branch_user" class="form-control">--}}
{{--                                @foreach($Users as $user)--}}
{{--                                    <option @if($user->id == $Branch->user_id ) selected @endif value="{{$user->id}}">{{$user->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
                        </div>

                        <div class="input-style">
                            <button class="btn btn-success"> حفظ التعديلات </button>
                        </div>

                    </form>

                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
