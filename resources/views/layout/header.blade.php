<!DOCTYPE html>
<html dir="{{__('navbar.dir')}}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0" />
    <meta name="description" content="Barbershop Booking Space">
    <meta name="author" content="Gamal El_halwany">
    <title>@yield('title','unknow')</title>

    <!-- EXTERNAL CSS LINKS -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('Design/fonts/css/all.main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Design/css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Design/css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Design/css/barber-icons.css')}}">

    <!-- CUSTOM PAGE STYLE -->
    @stack('style')

    <!-- GOOGLE FONTS  -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prata&display=swap" rel="stylesheet">
    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Noto+Kufi+Arabic:wght@100;200;300;400;500;600;700;800;900&display=swap">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<!-- BODY -->

<body>
    <!-- START NAVBAR SECTION -->

    <header id="header" class="header-section">
        <div class="container">
            <nav class="navbar">
                <a href="#" class="navbar-brand">
                    <img src="{{asset('Design/images/Africa_Barber_Logo.png')}}" alt="Barbershop Logo" width="250px" height="100%">
                </a>
                <div class="d-flex menu-wrap align-items-center main-menu-container">
                    <div class="mainmenu" id="mainmenu">
                        <ul class="nav">
                            <li><a href="{{ url('../') }}/#home-section">{{__('navbar.home')}}</a></li>
                            <li><a href="{{ url('../') }}/#about">{{__('navbar.about')}}</a></li>
                            <li><a href="{{ url('../') }}/#services">{{__('navbar.services')}}</a></li>
                            <li><a href="{{ url('../') }}/#gallery">{{__('navbar.gallery')}}</a></li>
                            <li><a href="{{ url('../') }}/#pricing">{{__('navbar.pricing')}}</a></li>
                            <!-- <li><a href="./#contact-us">{{__('navbar.contact')}}</a></li> -->
                            <!-- <li><a href="/{{__('navbar.lang')}}">{{__('navbar.lang')}}</a></li> -->
                        </ul>
                    </div>
                    @if(request()->routeIs('chairs.front'))
                    @else
                    <div class="header-btn" style="margin-left:10px">
                        <a href="{{route('chairs.front')}}" class="menu-btn">{{__('navbar.make_appointment')}}</a>
                    </div>
                    @endif
                </div>
                <a class="mob-menu-toggle">
                    <i class="fa fa-bars"></i>
                </a>
            </nav>
        </div>
    </header>

    <div class="header-height" style="height: 80px;"></div>

    <!-- END NAVBAR SECTION -->

    <!-- START MOBILE NAVBAR -->

    <div id="menu_mobile" class="menu-mobile-menu-container" style="text-align: right;">
        <ul class="mob-menu-top">
            <li class="menu-header">
                <a href="#">القائمة</a>
            </li>
            <li style="display: inline-block;">
                <a class="mob-close-toggle" style="cursor: pointer;width: 75px;">
                    <i class="fas fa-times" style="color: white;"></i>
                </a>
            </li>
        </ul>
        <div class="menu-tab-div">
            <ul id="mobile-menu" class="menu">
                <li><a href="{{ url('../') }}/#home-section">{{__('navbar.home')}}</a></li>
                <li><a href="{{ url('../') }}/#about">{{__('navbar.about')}}</a></li>
                <li><a href="{{ url('../') }}/#services">{{__('navbar.services')}}</a></li>
                <li><a href="{{ url('../') }}/#gallery">{{__('navbar.gallery')}}</a></li>
                <li><a href="{{ url('../') }}/#pricing">{{__('navbar.pricing')}}</a></li>
                <li>
                    @if(request()->routeIs('chairs.front'))
                    @else
                    <div class="header-btn">
                        <a href="{{route('chairs.front')}}" class="menu-btn">{{__('navbar.make_appointment')}}</a>
                    </div>
                </li>
            </ul>
        </div>
        @endif
    </div>

    <!-- END NAVBAR MOBILE -->


    @yield('content')


    @section('footer')
    <footer class="footer_section padding-0">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 xs-padding">
                    <div class="copyright">
                        copyright
                        <script type="text/javascript">
                            document.write(new Date().getFullYear())
                        </script>
                        ©
                        Africabarber Services Powered by
                        <strong class="text-danger">
                            {{config('app.developer')}}
                        </strong>
                    </div>
                </div>
                <!-- <div class="col-md-12 xs-padding">
                    <ul class="footer_social">
                        <li><a href="#">Orders</a></li>
                        <li><a href="#">Terms</a></li>
                        <li><a href="#">Report Problem</a></li>
                    </ul>
                </div> -->
            </div>
        </div>
    </footer>
    @show
    <!-- INCLUDE JS SCRIPTS -->
    <script src="{{asset('Design/js/jquery.min.js')}}"></script>
    <script src="{{asset('Design/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('Design/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('Design/js/main.js')}}"></script>
    @stack('script')

</body>

<!-- END BODY TAG -->

</html>