<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0"/>
        <meta name="description" content="Barbershop Booking Space">
        <meta name="author" content="Mustafa Gamal">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('Design/css/login.css')}}">

        <title>تسجيل دخول | المستخدم</title>
    </head>
<body>

<header>
    <nav>
        <ul class="login-navbar-list-items">
            <li class="login-navbar-item">
                <a href="/">
                    <img src="{{asset('Design/images/barbershop_logo.png')}}" alt="Brand Image" title="Brand">
                </a>
            </li>
            <li class="login-navbar-item"><a href="/">الرئيسية</a></li>
        </ul>
    </nav>
</header>

{{-- START LOGIN SECTION --}}
<div class="user-login-container">
    <div class="user-login-content">
        <div class="user-login">

            <div class="user-login-info" id="test">
{{--                <img src="{{asset('/Design/images/scissor2.png')}}">--}}
            </div>

            <form action="{{route('login')}}" method="POST">
                @csrf
                <div class="input-content">
                    <div class="user-image">
                        <img src="https://fakeimg.pl/300/" alt="User Image" title="User">
                    </div>
                    <div class="login-form-title">
                        <h5>تسجيل دخول المستخدم</h5>
                    </div>
                    <div class="error-list">
                        @error('email')
                        <div class="login-error-list-content">
                            <div class="login-error-list">
                                @foreach($errors->get('email') as $error)
                                    <p>{{$error}}</p>
                                @endforeach
                            </div>
                        </div>
                        @enderror
                    </div>
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="البريد الالكتروني">
                    </div>
                    <div class="error-list">
                        @error('password')
                        <div class="login-error-list-content">
                            <div class="login-error-list">
                                @foreach($errors->get('password') as $error)
                                    <p>{{$error}}</p>
                                @endforeach
                            </div>
                        </div>
                        @enderror
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" min="5" max="255" placeholder="كلمة المرور">
                    </div>
                     <div class="input-group">
                         <button type="submit" class="btn btn-warning">
                             <i class="ri-login-box-line"></i>دخول
                         </button>
                     </div>
                </div>

            </form>
        </div>
    </div>
</div>
{{-- END LOGIN SECTION --}}

<script src="{{asset('Design/js/login.js')}}"></script>
</body>
</html>
