<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0" />
    <meta name="description" content="Barbershop Booking Space">
    <meta name="author" content="Gamal El_halwany">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('Design/css/dashboard.css')}}">
    @stack('style')
    <title> @yield('title','unkonw')</title>
</head>

<body dir="rtl">

    <!-- START USER SECTION -->

    <div class="dashboard-container">
        <div class="dashboard-content">
            <div class="dashboard-header-content">
                <div class="dashboard-header">

                    <div class="dashboard-header-user-login-data">
                        <h4><i class="ri-computer-line"></i> <span>{{env('App_NAME')}}</span></h4>
                    </div>

                    <div class="dashboard-header-list">

                        <ul class="dashboard-header-list-items">
                            <li class="dashboard-header-item">
                                <strong>
                                    {{auth()->user()->branch->name}}
                                </strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="dashboard">
                <!-- Responsive Sidebar -->
                <div class="burger-menu">
                    <ul>
                        <li class="list-list-item avatar">
                            <img src="https://fakeimg.pl/200/" alt="User Image" title="User Image">
                            <span>
                                {{auth()->user()->name}}
                            </span>
                        </li>

                        <a href="/dashboard/index">
                            <li class="list-list-item">
                                <i class="ri-home-line"></i> <span>الرئيسية</span>
                            </li>
                        </a>

                        <a href="{{route('dashboard.users.index')}}">
                            <li class="list-list-item">
                                <i class="ri-user-line"></i> <span>المستخدمين</span>
                            </li>
                        </a>


                        <a href="{{route('dashboard.branches.index')}}">
                            <li class="list-list-item">
                                <i class="ri-store-line"></i> <span>الفروع</span>

                            </li>
                        </a>

                        <a href="{{route('dashboard.roles.index')}}">
                            <li class="list-list-item">
                                <i class="ri-equalizer-line"></i> <span>الصلاحيات</span>
                            </li>
                        </a>

                        <a href="javascript:void();" data-toggle="collapse" data-target="#elements-time">
                            <li class="list-list-item">
                                <i class="fas fa-chair"></i> <span>الكراسي</span>
                            </li>
                        </a>
                        <ul id="elements-time" class="collapse side-dropdown-element" data-parent="#sidebarnav">
                            <a href="{{route('dashboard.chairs.index')}}">
                                <li class="list-list-item">
                                    <i class="fas fa-chair"></i>
                                    <span>جميع الكراسي</span>
                                </li>
                            </a>
                            <a href="{{route('chair.process')}}">
                                <li class="list-list-item">
                                    <i class="fas fa-hourglass-start"></i>
                                    <span>وقت المستهلك للكرسي</span>
                                </li>
                            </a>
                        </ul>


                        <a href="{{route('dashboard.jobs.index')}}">
                            <li class="list-list-item">
                                <i class="ri-printer-cloud-fill"></i>
                                 <span>الوظائف</span>
                            </li>
                        </a>

                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#categories">
                            <li class="list-list-item">
                                <i class="fas fa-layer-group"></i> <span>الفئات</span>
                            </li>
                        </a>
                        <ul id="categories" class="collapse side-dropdown-element" data-parent="#sidebarnav">
                            <a href="{{route('categories.index')}}">
                                <li class="list-list-item">
                                    <i class="fas fa-stream"></i>
                                    <span>جميع الفئات</span>
                                </li>
                            </a>
                            <a href="{{route('categories.create')}}">
                                <li class="list-list-item">
                                    <i class="fas fa-cash-register"></i>
                                    <span> انشاء فئة جديدة</span>
                                </li>
                            </a>
                        </ul>

                        <a href="{{route('dashboard.products.index')}}">
                            <li class="list-list-item">
                                <i class="ri-product-hunt-line"></i>
                                <span> الخدمات والمنتجات</span>
                            </li>
                        </a>

                        <a href="{{route('dashboard.salary.index')}}">
                            <li class="list-list-item">
                                <i class="fa-solid fa-dollar-sign"></i> <span>المرتبات</span>
                            </li>
                        </a>

                        <a href="{{route('reservations')}}">
                            <li class="list-list-item">
                                <i class="fas fa-calendar-alt"></i> <span>الحجوزات</span>
                            </li>
                        </a>

                        <a href="{{route('reports.index')}}">
                            <li class="list-list-item">
                                <i class="fas fa-chart-line"></i> <span>التقارير</span>
                            </li>
                        </a>

                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                            <li class="list-list-item">
                                <i class="far fa-money-bill-alt"></i> <span>المصروفات</span>
                            </li>
                        </a>
                        <ul id="elements" class="collapse side-dropdown-element" data-parent="#sidebarnav">
                            <a href="{{route('expenses.index')}}">
                                <li class="list-list-item">
                                    <i class="fas fa-layer-group"></i>
                                    <span>جميع المصروفات</span>
                                </li>
                            </a>
                            <a href="{{route('expenses.create')}}">
                                <li class="list-list-item">
                                    <i class="fas fa-cash-register"></i>
                                    <span> تسجيل مصروف او سلفة </span>
                                </li>
                            </a>
                        </ul>
                    </ul>
                </div>
                @yield('body')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{asset('Design/js/login.js')}}"></script>
    <script src="{{asset('Design/js/global.js')}}"></script>
    <script>
        $("div.burger-menu li:first-child").click(function() {
            $("div.burger-menu").toggleClass("open")
        });
    </script>
</body>

</html>