@extends('dashboard.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{asset('Design/css/users/main.css')}}">
@endpush
@section('title','إضافة مستخدم جديد')

@section('body')
    <div class="body">
        <div class="create-user-container">

            <div class="create-user-head">
                <a class="btn btn-info" href="{{ route('dashboard.users.index') }}">
                    <i style="vertical-align: middle" class="fa-solid fa-backward"></i>
                    رجوع
                </a>
                <h5> انشاء مستخدم جديد </h5>
            </div>


            <div class="create-user-content">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> .هناك بعض الاخطاء في المدخلات<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! Form::open(array('route' => 'dashboard.users.store','method'=>'POST')) !!}
                    <div class="row">
                        <div class="style">
                            <div class="form-group">
                                <strong>الاسم:</strong>
                                {!! Form::text('name', null, array('placeholder' => 'الاسم','class' => 'form-control',old('name'))) !!}
                            </div>
                        </div>
                        <div class="style">
                            <div class="form-group">
                                <strong>البريد الالكتروني:</strong>
                                {!! Form::text('email', null, array('placeholder' => 'البريد الالكتروني','class' => 'form-control',old('email'))) !!}
                            </div>
                        </div>
                        <div class="style">
                            <div class="form-group">
                                <strong>كلمة المرور:</strong>
                                {!! Form::password('password', array('placeholder' => 'كلمة المرور','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="style">
                            <div class="form-group">
                                <strong>تأكيد كلمة المرور:</strong>
                                {!! Form::password('confirm-password', array('placeholder' => 'تأكيد كلمة المرور','class' => 'form-control')) !!}
                            </div>
                        </div>



                        {{--*********************************--}}
                        <div class="style">
                            <div class="form-group">
                                <strong>أسم المستخدم:</strong>
                                <input type="text" class="form-control" name="username" placeholder="أسم المستخدم" value="{{old('username')}}">
                            </div>
                        </div>
                        <div class="style">
                            <div class="form-group">
                                <strong>رقم الهوية:</strong>
                                <input type="text"  class="form-control" name="national_id" placeholder="رقم الهوية" value="{{old('national_id')}}">
                            </div>
                        </div>
                        <div class="style">
                            <div class="form-group">
                                <strong>الرقم الوظيفي:</strong>
                                <input type="number"  class="form-control" name="emp_id" placeholder="الرقم الوظيفي" value="{{old('emp_id')}}">
                            </div>
                        </div>

                        <div class="style">
                            <div class="form-group">
                                <strong>تاريخ التوظيف:</strong>
                                <input type="datetime-local"  class="form-control" name="hiring_date" placeholder="تاريخ التوظيف"  value="{{old('hiring_date')}}">
                            </div>
                        </div>

                        <div class="style">
                            <div class="form-group">
                                <strong>أسم الوظيفة:</strong>
                                <select name="job_id" class="form-control">
                                    @foreach($jobs as $job)
                                        <option value="{{$job->id}}" @if(old('job_id') == $job->id) selected @endif>{{$job->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="style">
                            <div class="form-group">
                                <strong>نظام المرتب:</strong>
                                <select name="salary_system" onchange="UserStateHideInputs()" class="form-control">
                                    <option value="basic" @if(old('salary_system') == 'basic') selected @endif>عادي</option>
                                    <option value="commotion" @if(old('salary_system') == 'commotion') selected @endif>عموله</option>
                                    <option value="basic_and_commotion" @if(old('salary_system') == 'basic_and_commotion') selected @endif>عادي و عموله</option>
                                </select>
                            </div>
                        </div>


                        <div class="style" id="commotion">
                            <div class="form-group">
                                <strong>نسبة العمولة بالارقام:</strong>
                                <input type="number"  class="form-control" step="0.01" name="commotion" placeholder="نسبة العمولة بالارقام" value="{{old('commotion')}}">
                            </div>
                        </div>



                        <div id="user_state">
                            <div class="style">
                                <div class="form-group">
                                    <strong>المرتب بالارقام:</strong>
                                    <input type="number"  class="form-control" step="0.01" name="salary" placeholder="المرتب بالارقام"  value="{{old('salary')}}">
                                </div>
                            </div>
                            <div class="style">
                                <div class="form-group">
                                    <strong>عدد ايام العمل المطلوبة:</strong>
                                    <input type="number"  class="form-control" name="work_days" placeholder="عدد ايام العمل المطلوبة " value="{{old('work_days')}}">
                                </div>
                            </div>

                            <div class="style">
                                <div class="form-group">
                                    <strong>عدد ساعات العمل المطلوبة:</strong>
                                    <input type="number"  class="form-control" name="work_hours" placeholder="عدد ساعات العمل المطلوبة" value="{{old('work_hours')}}">
                                </div>
                            </div>
                        </div>

                        <div class="style">
                            <div class="form-group">
                                <strong>النوع:</strong>
                                <select name="gender" class="form-control">
                                    <option value="male">ذكر</option>
                                    <option value="female">انثي</option>
                                </select>
                            </div>
                        </div>


                        <div class="style">
                            <div class="form-group">
                                <strong>الفرع:</strong>
                                <select name="branch_id" class="form-control">
                                    @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>




                        <div class="style">
                            <div class="form-group">
                                <strong>الصلاحية:</strong>
                                {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">أنشاء</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>








    </div>
@endsection
