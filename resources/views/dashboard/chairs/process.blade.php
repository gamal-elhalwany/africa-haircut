@extends('dashboard.layouts.app')

@push('style')
<link rel="stylesheet" href="{{asset('Design/css/salary/main.css')}}">
<style>
    .body {
        font-family: 'Cairo', sans-serif;
        direction: rtl;
        background-color: #f4f6f9;
        padding: 20px;
    }

    /* Salary container */
    .salary-container {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Header */
    .salary-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .salary-head h5 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
    }

    .salary-head a {
        font-size: 16px;
        display: inline-flex;
        align-items: center;
        color: #ffffff;
        padding: 8px 20px;
        background-color: #17a2b8;
        border-radius: 30px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .salary-head a:hover {
        background-color: #138496;
    }

    .salary-head i {
        margin-left: 5px;
    }

    /* Content */
    .salary-content {
        margin-top: 30px;
    }

    .salary-content form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .input-style {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .input-style select,
    .input-style input,
    .input-style button {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .input-style button {
        background-color: #17a2b8;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .input-style button:hover {
        background-color: #138496;
    }

    /* Error messages */
    ul {
        padding: 0;
        margin: 10px 0;
        list-style: none;
    }

    ul li {
        color: #721c24;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
    }
</style>
@endpush

@section('title','افريقيا' . ' || ' . 'الكراسي')

@section('body')
<div class="body">
    <div class="salary-container">
        <div class="salary-head">
            <a class="btn btn-info" href="{{route('dashboard.index')}}">
                <i class="fa-solid fa-backward"></i>
                الرئيسية
            </a>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h5 class="m-3">الوقت المنقضي لكل كرسي خلال كل عملية</h5>
                <form action="{{route('chair.process.time')}}" method="POST">
                    @csrf
                    <select class="form-control mb-3" name="chair_process">
                        <option>Choose Chair</option>
                        @foreach($chairs as $chair)
                        <option value="{{$chair->id}}">{{$chair->number}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-outline-primary btn-lg">تحقق</button>
                </form>

                @if(request('chair_process'))
                <table class="table table-hover table-bordered text-center mt-3">
                    <thead>
                        <tr>
                            <th>رقم الكرسي</th>
                            <th>اسم الموظف</th>
                            <th>الوقت المستهلك</th>
                            <th>التاريخ</th>
                        </tr>
                    </thead>
                    @foreach($chairProcesses as $chair)
                    <tbody>
                        <td>{{ $chair->chair->number }}</td>
                        <td>{{ $chair->user->name }}</td>
                        <td>{{ $chair->check_in->diffInMinutes($chair->check_out) }} دقيقة</td>
                        <td>{{ \Carbon\Carbon::parse($chair->created_at)->diffForHumans() }}</td>
                    </tbody>
                    @endforeach
                </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection