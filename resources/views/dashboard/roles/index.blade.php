@extends('dashboard.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{asset('Design/css/roles/main.css')}}">
@endpush
@section('title','الصلاحيات')
@section('body')
    <div class="body">
        <div  class="show-roles-container">
            @can('انشاء-صلاحية')
            <div class="show-roles-head">
                <a class="btn btn-success" href="{{ route('dashboard.roles.create') }}">
                    إضافة صلاحية جديده
                </a>
            </div>
            @endcan

            <div class="show-roles-content">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="show-roles">
                    <ul class="show-roles-list-items">
                        @foreach ($roles as $key => $role)
                                <li class="show-roles-item">
                                    <p> {{ $role->name }}  </p>

                                    <div class="show-roles-item-control">
                                        <a class="btn btn-info" href="{{ route('dashboard.roles.show',$role->id) }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        @can('تعديل-صلاحية')
                                            <a class="btn btn-primary" href="{{ route('dashboard.roles.edit',$role->id) }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        @endcan
                                        @can('حذف-صلاحية')
                                            <form action="{{route('dashboard.roles.destroy',$role->id)}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        @endcan
                                    </div>

                                </li>
                        @endforeach
                    </ul>
                </div>
                {!! $roles->render() !!}

            </div>
        </div>
    </div>

@endsection
