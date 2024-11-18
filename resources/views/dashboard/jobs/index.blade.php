@extends('dashboard.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{asset(env('App_Design_Url').'/Design/css/jobs/main.css')}}">
@endpush
@section('title','الوظائف')

@section('body')
    <div class="body jobs-parent-container">
            <div class="jobs-container">

                <div class="jobs-head">
                    <a class="btn btn-success" href="{{ route('dashboard.jobs.create') }}">
                        إنشاء وظيفه جديده
                    </a>
                    <h5>جميع الوظائف المتاحه</h5>
                </div>


                <div class="jobs-content">

                        <div class="job-success-msg">
                            @if ($message = Session::get('success'))
                                <p>{{ $message }}</p>
                            @endif
                        </div>
                    <div class="job">
                    @foreach ($Jobs as $Job)

                          <div class="job-info">
                              <div class="job-name">
                                  {{ $Job->name }}
                              </div>
                              <div class="job-footer">
                                  <a class="btn btn-info" href="{{ route('dashboard.jobs.show',$Job->id) }}"><i class="fa-solid fa-eye"></i></a>
                                  <a class="btn btn-primary" href="{{ route('dashboard.jobs.edit',$Job->id) }}"> <i class="fa-solid fa-pen-to-square"></i></a>
                                  <form action="{{route('dashboard.jobs.destroy',$Job->id)}}" method="POST">
                                      @method('DELETE')
                                      @csrf
                                      <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                  </form>
                              </div>

                          </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
@endsection
