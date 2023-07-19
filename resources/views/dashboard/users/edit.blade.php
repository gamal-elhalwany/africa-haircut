@extends('dashboard.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{asset(env('App_Design_Url').'/Design/css/users/main.css')}}">
@endpush
@section('title','تعديل بيانات المسستخدم')
@section('body')
    <div class="body">
        <div class="create-user-container">

            <div class="create-user-head">
                <a class="btn btn-info" href="{{ route('dashboard.users.index') }}">
                    <i style="vertical-align: middle" class="fa-solid fa-backward"></i>
                    رجوع
                </a>
                <p class="edit-user-data-text"> تعديل بيانات <span>{{$user->name}}</span> </p>
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
                <div>
                    <h5>
                            الصلاحيات الحاليه :
                        @foreach($user->roles as $UserRoles)
                                , {{$UserRoles->name}}
                        @endforeach
                    </h5>
                </div>
                {!! Form::model($user,['method' => 'PATCH','route' => ['dashboard.users.update', $user->id]]) !!}
                <div class="row">
                    <div class="style">
                        <div class="form-group">
                            <strong>الاسم:</strong>
                            {!! Form::text('name', null, array('placeholder' => 'الاسم','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="style">
                        <div class="form-group">
                            <strong>البريد الالكتروني:</strong>
                            {!! Form::text('email', null, array('placeholder' => 'البريد الالكتروني','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="style">
                        <div class="form-group">
                            <strong>كلمة المرور:</strong>

                            {!! Form::password('password', array('placeholder' => 'كلمة المرور', 'class' => 'form-control')) !!}
                        </div>
                    </div>

                    {{--*********************************--}}
                    <div class="style">
                        <div class="form-group">
                            <strong>أسم المستخدم:</strong>
{{--                            <input type="text" class="form-control" name="username" placeholder="User Name">--}}
                            {!! Form::text('username', null, array('placeholder' => 'أسم المستخدم','class' => 'form-control')) !!}

                        </div>
                    </div>
                    <div class="style">
                        <div class="form-group">
                            <strong>رقم الهوية:</strong>
{{--                            <input type="number"  class="form-control" name="national_id" placeholder="National  ID">--}}

                            {!! Form::text('national_id', null, array('placeholder' => 'رقم الهوية','class' => 'form-control')) !!}

                        </div>
                    </div>
                    <div class="style">
                        <div class="form-group">
                            <strong>الرقم والوظيفي:</strong>
{{--                            <input type="number"  class="form-control" name="emp_id" placeholder="Emp  ID">--}}

                            {!! Form::number('emp_id', null, array('placeholder' => 'الرقم والوظيفي','class' => 'form-control')) !!}

                        </div>
                    </div>

                    <div class="style">
                        <div class="form-group">
                            <strong>تاريخ التوظيف:</strong>
                            <input type="datetime-local"  class="form-control" name="تاريخ التوظيف" value="{{$user->hiring_date}}" placeholder="Hiring Date">
                        </div>
                    </div>

                    <div class="style">
                        <div class="form-group">
                            <strong>أسم الوظيفة:</strong>
                            <select name="job_id" class="form-control">
                                @foreach($jobs as $job)
                                    <option  @if($user->job_id == $job->id) selected @endif value="{{$job->id}}">{{$job->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="style">
                        <div class="form-group">
                            <strong>نظام المرتب:</strong>
                            <select name="salary_system" class="form-control" onchange="UserStateHideInputs()" >
                                <option  @if($user->salary_system == 'basic') selected @endif value="basic">عادي</option>
                                <option  @if($user->salary_system == 'commotion')selected @endif value="commotion">عموله</option>
                                <option  @if($user->salary_system == 'basic_and_commotion')) selected @endif value="basic_and_commotion">عادي و عموله</option>
                            </select>
                        </div>
                    </div>





                    <div class="style" id="commotion">
                        <div class="form-group">
                            <strong>نسبة العمولة بالارقام:</strong>
                            <input type="number"  class="form-control" step="0.01" name="commotion" placeholder="نسبة العمولة بالارقام" value="{{$user->commotion}}">
                        </div>
                    </div>




                        <div id="user_state">
                            <div class="style">
                                <div class="form-group">
                                    <strong>المرتب بالارقام:</strong>
                                    <input type="number"  class="form-control" step="0.01" name="salary" placeholder="المرتب بالارقام"  value="{{$user->salary}}">
                                </div>
                            </div>
                            <div class="style">
                                <div class="form-group">
                                    <strong>عدد ايام العمل المطلوبة:</strong>
                                    <input type="number"  class="form-control" name="work_days" placeholder="عدد ايام العمل المطلوبة " value="{{$user->work_days}}">
                                </div>
                            </div>

                            <div class="style">
                                <div class="form-group">
                                    <strong>عدد ساعات العمل المطلوبة:</strong>
                                    <input type="number"  class="form-control" name="work_hours" placeholder="عدد ساعات العمل المطلوبة" value="{{$user->work_hours}}">
                                </div>
                            </div>
                        </div>

                    <div class="style">
                        <div class="form-group">
                            <strong>Gender :</strong>
                            <select name="gender" class="form-control">
                                <option @if($user->gender == 'male') selected @endif value="male">ذكر</option>
                                <option @if($user->gender == 'female') selected @endif value="female">انثي</option>
                            </select>
                        </div>
                    </div>


                    <div class="style">
                        <div class="form-group">
                            <strong>الفرع:</strong>
                            <select name="branch_id" class="form-control">
                                @foreach($branches as $branch)
                                    <option @if($user->branch_id == $branch->id) selected @endif value="{{$branch->id}}">{{$branch->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>






                    <div class="style">
                        <div class="form-group">
                            <strong>الصلاحية:</strong>

{{--                       {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}--}}

                            <select name="roles[]" class="form-control" multiple>
                                @foreach($roles as $role)
                                        <option value="{{$role}}"
                                        @foreach($user->roles as $UserRole)
                                            @if($UserRole->name == $role)
                                                selected
                                            @endif
                                            @endforeach>
                                            {{$role}}
                                        </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>








    </div>



@endsection
