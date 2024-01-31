@extends('dashboard.layouts.app')
@push('style')
 <link rel="stylesheet" href="{{asset('Design/css/branches/main.css')}}">
@endpush
@section('title','الفروع')

@section('body')
    <div class="body">
            <div class="branches-container">

                <div class="branches-header">
                    <a href="{{route('dashboard.branches.create')}}">
                        <button type="button" class="btn btn-primary">إضافة فرع جديد</button>
                    </a>
                </div>

                <div class="branches-meg">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    @if($errors->has('BranchError'))
                        <li>{{ $errors->first('BranchError') }}</li>
                    @endif
                </div>


                <div class="branches-content">


                    @if($Branches->count() > 0)
                        <div class="branches">
                            @foreach($Branches as $Branch)
                                <div class="branches-direct">


                                    <div id="delete_branch_container" class="delete-branch-container">
                                        <div class="delete-branch-content">

                                                <div class="delete-branch">

                                                    <div class="delete-branch-note">
                                                        <p class="delete-branch-note-text">
                                                            هل انت متأكد
                                                        </p>
                                                    </div>

                                                    <div class="delete-branch-btn">

                                                        <div id="close_delete_branch_container" class="close-delete">
                                                            <button  class="btn btn-dark">
                                                                الغاء
                                                            </button>
                                                        </div>

                                                        <form action="{{route('dashboard.branches.destroy',$Branch->id)}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">حذف</button>
                                                        </form>

                                                    </div>
                                                </div>
                                        </div>
                                    </div>



                                    <div class="delete-btn">
                                        <button id="show_delete_branch_box" class="btn btn-danger">حذف</button>
                                    </div>

                                    <img src="https://fakeimg.pl/200/">
                                    <h3>{{$Branch->name}} </h3>
                                    <div class="btn">
                                        <a href="{{route('dashboard.branches.edit',$Branch->id)}}">
                                            <button class="btn btn-dark">تعديل  </button>
                                        </a>
                                        <a href="{{route('dashboard.branches.show',$Branch->id)}}">
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
