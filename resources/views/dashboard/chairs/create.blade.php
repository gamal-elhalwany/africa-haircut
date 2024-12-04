@extends('dashboard.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('Design/css/chairs/main.css')}}">
@endpush
@section('title','إضافة كرسي جديد')

@section('body')
<div class="body">
    <div class="create-chair-container">

        <div class="create-chair-content">

            <div class="chair-meg col-md-6 offset-md-3">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
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
            </div>

            <a class="btn btn-info" href="{{route('dashboard.chairs.index')}}">
                <i style="vertical-align: middle" class="fa-solid fa-backward"></i>
                رجوع
            </a>
            <div class="create-chair">
                <form action="{{route('dashboard.chairs.store')}}" method="POST">
                    @csrf
                    <div class="input-style">
                        <select name="branch_id" class="form-control">
                            @foreach($Branches as $Branch)
                            <option value="{{$Branch->id}}">{{$Branch->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-style">
                        <input type="text" class="form-control" name="floor" placeholder="الدور">
                    </div>
                    <div class="input-style">
                        <input type="number" class="form-control" name="number" placeholder="رقم">
                    </div>

                    <div class="input-style">
                        <button class="btn btn-success">إضافة الأن</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection