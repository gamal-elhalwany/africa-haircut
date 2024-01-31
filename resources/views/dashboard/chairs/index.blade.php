@extends('dashboard.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{asset('Design/css/chairs/main.css')}}">
@endpush
@section('title','الكراسي')

@section('body')
    <div class="body">
        <div class="chair-container">


            <div class="chair-meg">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
            </div>



            <div class="chair-content">

                <a href="{{route('dashboard.chairs.create')}}">
                    <button type="button" class="btn btn-primary">إضافة كرسي جديد</button>
                </a>

                @if($Chairs->count() > 0)

                    <div class="chair">
                        @foreach($Chairs as $Chair)

                            <div class="chair-direct">
                                <div class="delete-btn">
                                    <form action="{{route('dashboard.chairs.destroy',$Chair->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">حذف</button>
                                    </form>
                                </div>

                                <img src="https://l.top4top.io/p_26550dd1k1.jpg">
                                <div class="chair-details">
                                    <h6>  كرسي  : {{$Chair->number}} </h6>
                                    <p> الدور  : {{$Chair->floor}} </p>
                                    <p>  فرع  : {{$Chair->branch->name}} </p>
                                </div>

                                <div class="btn">
                                    <a href="{{route('dashboard.chairs.edit',$Chair->id)}}">
                                        <button class="btn btn-dark">تعديل  </button>
                                    </a>
                                    <a href="{{route('dashboard.chairs.show',$Chair->id)}}">
                                        <button class="btn btn-info">عرض التفاصيل</button>
                                    </a>
                                </div>

                            </div>
                        @endforeach
                    </div>



                @endif
            </div>
        </div>






    </div>
@endsection
