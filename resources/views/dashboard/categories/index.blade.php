@extends('dashboard.layouts.app')

@section('title','أفريقيا' . ' || ' . 'انشاء فئة')

@section('body')
<div class="body">
    <div class="salary-container">
        <div class="container-fluid text-center">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-info" href="{{route('dashboard.index')}}" style="float: right;">
                                <i class="fa-solid fa-backward"></i>
                                الرئيسية
                            </a>
                            <h3>جميع الفئات</h3>
                            <hr class="mt-4"/>
                            <div class="row">
                                @foreach($categories as $category)
                                <div class="col-md-3 mt-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <strong>اسم الفئة:</strong>
                                            <h5 class="card-title">{{$category->name}}</h5>
                                            @can('حذف-منتج')
                                            <form action="{{route('categories.destroy', $category->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection