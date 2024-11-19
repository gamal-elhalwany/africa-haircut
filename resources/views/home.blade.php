@extends('layout/header')
@section('title')
{{__('navbar.title')}}
@endsection

@section('content')
@push('style')
<style>
    .scroll-top {
        position: fixed;
        z-index: 999999;
        right: 40px;
        top: 85%;
        color: #fff;
        background-color: #9e8a78;
        border: none;
        border-radius: 5px;
        padding: 8px 14px;
        cursor: pointer;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        display: none;
    }

    .scroll-top:hover {
        scale: 1.1 1.1;
        transition: all 0.3s ease-in-out;
    }

    .scroll-top:focus {
        outline: none;
    }
</style>
@endpush
<!-- HOME SECTION -->
<button class="scroll-top" id="scroll-top">
    <i class="fas fa-angle-double-up"></i>
</button>

<section class="home-section" id="home-section">
    <div class="home-section-content">
        <div id="home-section-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#home-section-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#home-section-carousel" data-slide-to="1"></li>
                <li data-target="#home-section-carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <!-- FIRST SLIDE -->
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{asset('Design/images/barbershop_image_1.jpg')}}" alt="First slide">
                    <div class="carousel-caption d-md-block">
                        <h3>إنها ليست مجرد قصة شعر، بل هي تجربة.</h3>
                        <p>
                            صالون الحلاقة الخاص بنا هو منطقة تم إنشاؤها خصيصًا للرجال الذين يقدرون
                            الجودة الممتازة والوقت والمظهر الخالي من العيوب.
                        </p>
                    </div>
                </div>
                <!-- SECOND SLIDE -->
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('Design/images/barbershop_image_2.jpg')}}" alt="Second slide">
                    <div class="carousel-caption d-md-block">
                        <h3>إنها ليست مجرد قصة شعر، بل هي تجربة.</h3>
                        <p>
                            صالون الحلاقة الخاص بنا هو منطقة تم إنشاؤها خصيصًا للرجال الذين يقدرون
                            الجودة الممتازة والوقت والمظهر الخالي من العيوب.
                        </p>
                    </div>
                </div>
                <!-- THIRD SLIDE -->
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('Design/images/barbershop_image_3.jpg')}}" alt="Third slide">
                    <div class="carousel-caption d-md-block">
                        <h3>إنها ليست مجرد قصة شعر، بل هي تجربة.</h3>
                        <p>
                            صالون الحلاقة الخاص بنا هو منطقة تم إنشاؤها خصيصًا للرجال الذين يقدرون
                            الجودة الممتازة والوقت والمظهر الخالي من العيوب.
                        </p>
                    </div>
                </div>
            </div>
            <!-- PREVIOUS & NEXT -->
            <a class="carousel-control-prev" href="#home-section-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#home-section-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>

<!-- ABOUT SECTION -->

<section id="about" class="about_section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="about_content" style="text-align: center;">
                    <h3>{{__('body.introducing')}}</h3>
                    <h2>صالون حلاقة افريكان<br> منذ عام 1991</h2>
                    <img src="{{asset('Design/images/about-logo.png')}}" alt="logo">
                    <p style="color: #777">
                        لحلاق هو الشخص الذي تتمثل وظيفته بشكل أساسي في قص شعر العريس وتصفيفه للرجال والأولاد. يُعرف مكان عمل الحلاق باسم "مكان الحلاقة" أو "صالون الحلاقة". كما تعد محلات الحلاقة أماكن للتفاعل الاجتماعي والحوار العام. وفي بعض الحالات، تكون محلات الحلاقة أيضًا منتديات عام.
                    </p>
                    <a href="#" class="default_btn" style="opacity: 1;">المزيد عنا</a>
                </div>
            </div>
            <div class="col-md-6  d-none d-md-block">
                <div class="about_img" style="overflow:hidden">
                    <img class="about_img_1" src="{{asset('Design/images/about-1.jpg')}}" alt="about-1">
                    <img class="about_img_2" src="{{asset('Design/images/about-2.jpg')}}" alt="about-2">
                    <img class="about_img_3" src="{{asset('Design/images/about-3.jpg')}}" alt="about-3">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SERVICES SECTION -->

<section class="services_section" id="services">
    <div class="container">
        <div class="section_heading">
            <h3>{{__('setting.site_name')}}</h3>
            <h2>{{__('body.our_services')}}</h2>
            <div class="heading-line"></div>
        </div>
        <div class="row">
            @foreach ($services as $service)
            <div class="col-lg-3 col-md-6 padd_col_res">
                <div class="service_box">
                    {{-- <i class="bs bs-scissors-1"></i> --}}
                    <h3>{{$service->name}}</h3>
                    <p>{{$service->description}}</p>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

<!-- BOOKING SECTION -->

<section class="book_section" id="booking">
    <div class="book_bg"></div>
    <div class="map_pattern"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <form action="appointment.php" method="post" id="appointment_form" class="form-horizontal appointment_form" style="text-align:right">
                    <div class="book_content">
                        <h2 style="color: white;">حدد موعداً</h2>
                        <p style="color: #999;">
                            الحلاق هو الشخص الذي تكون مهنته بشكل أساسي قص الملابس وتصفيف الشعر
                            وحلاقة شعر الرجال والصبيان.
                        </p>
                    </div>
                    <!-- <div class="form-group row">
                        <div class="col-md-6 padding-10">
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-6 padding-10">
                            <input type="time" class="form-control">
                        </div>
                    </div> -->

                    <a id="app_submit" class="default_btn" href="{{route('chairs.front')}}">
                        حدد موعداً
                    </a>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- GALLERY SECTION -->

<section class="gallery-section" id="gallery">
    <div class="section_heading">
        <h3>صالون & منتجع صحى عصرى</h3>
        <h2>معرض الحلاق</h2>
        <div class="heading-line"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 gallery-column">
                <div style="height: 230px">
                    <div class="gallery-img" style="background-image: url('{{asset('Design/images/portfolio-1.jpg')}}');"> </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 gallery-column">
                <div style="height: 230px">
                    <div class="gallery-img" style="background-image: url({{asset('Design/images/portfolio-2.jpg')}});"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 gallery-column">
                <div style="height: 230px">
                    <div class="gallery-img" style="background-image: url({{asset('Design/images/portfolio-3.jpg')}});"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 gallery-column">
                <div style="height: 230px">
                    <div class="gallery-img" style="background-image: url({{asset('Design/images/portfolio-4.jpg')}});"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 gallery-column">
                <div style="height: 230px">
                    <div class="gallery-img" style="background-image: url({{asset('Design/images/portfolio-5.jpg')}});"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 gallery-column">
                <div style="height: 230px">
                    <div class="gallery-img" style="background-image: url({{asset('Design/images/portfolio-6.jpg')}});"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 gallery-column">
                <div style="height: 230px">
                    <div class="gallery-img" style="background-image: url({{asset('Design/images/portfolio-7.jpg')}});"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 gallery-column">
                <div style="height: 230px">
                    <div class="gallery-img" style="background-image: url({{asset('Design/images/portfolio-8.jpg')}});"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TEAM SECTION -->

<section id="team" class="team_section">
    <div class="container">
        <div class="section_heading ">
            <h3>صالون & منتجع صحى عصرى</h3>
            <h2>حلاقينا</h2>
            <div class="heading-line"></div>
        </div>
        <ul class="team_members row">
            <li class="col-lg-3 col-md-6 padd_col_res">
                <div class="team_member">
                    <img src="{{asset('Design/images/team-1.jpg')}}" alt="Team Member">
                </div>
            </li>
            <li class="col-lg-3 col-md-6 padd_col_res">
                <div class="team_member">
                    <img src="{{asset('Design/images/team-2.jpg')}}" alt="Team Member">
                </div>
            </li>
            <li class="col-lg-3 col-md-6 padd_col_res">
                <div class="team_member">
                    <img src="{{asset('Design/images/team-3.jpg')}}" alt="Team Member">
                </div>
            </li>
            <li class="col-lg-3 col-md-6 padd_col_res">
                <div class="team_member">
                    <img src="{{asset('Design/images/team-4.jpg')}}" alt="Team Member">
                </div>
            </li>
        </ul>
    </div>
</section>

<!-- REVIEWS SECTION -->

<section id="reviews" class="testimonial_section">
    <div class="container">
        <div id="reviews-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#reviews-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#reviews-carousel" data-slide-to="1"></li>
                <li data-target="#reviews-carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <!-- REVIEW 1 -->
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{asset('Design/images/barbershop_image_1.jpg')}}" alt="First slide" style="visibility: hidden;">
                    <div class="carousel-caption d-md-block">
                        <h3>إنها ليست مجرد قصة شعر، بل هي تجربة.</h3>
                        <p>
                            صالون الحلاقة الخاص بنا هو منطقة تم إنشاؤها خصيصًا للرجال الذين يقدرون
                            الجودة الممتازة والوقت والمظهر الخالي من العيوب.
                        </p>
                    </div>
                </div>
                <!-- REVIEW 2 -->
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('Design/images/barbershop_image_1.jpg')}}" alt="First slide" style="visibility: hidden;">
                    <div class="carousel-caption d-md-block">
                        <h3>إنها ليست مجرد قصة شعر، بل هي تجربة.</h3>
                        <p>
                            صالون الحلاقة الخاص بنا هو منطقة تم إنشاؤها خصيصًا للرجال الذين يقدرون
                            الجودة الممتازة والوقت والمظهر الخالي من العيوب.
                        </p>
                    </div>
                </div>
                <!-- REVIEW 3 -->
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('Design/images/barbershop_image_1.jpg')}}" alt="First slide" style="visibility: hidden;">
                    <div class="carousel-caption d-md-block">
                        <h3>إنها ليست مجرد قصة شعر، بل هي تجربة.</h3>
                        <p>
                            صالون الحلاقة الخاص بنا هو منطقة تم إنشاؤها خصيصًا للرجال الذين يقدرون
                            الجودة الممتازة والوقت والمظهر الخالي من العيوب.
                        </p>
                    </div>
                </div>
            </div>
            <!-- PREVIOUS & NEXT -->
            <a class="carousel-control-prev" href="#reviews-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#reviews-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>

<!-- PRICING SECTION  -->

<section class="pricing_section" id="pricing">
    <div class="container">
        <div class="section_heading">
            <h3>وفر 20% مع منتجع التجميل</h3>
            <h2>اسعار الحلاقة لدينا</h2>
            <div class="heading-line"></div>
        </div>
        <div class="row">


            <div class="col-lg-4 col-md-6 sm-padding">
                <div class="price_wrap">
                    <h3>الحلاقة</h3>
                    <ul class="price_list">
                        @foreach($services as $service)
                        <li>
                            <h4>{{$service->name}}</h4>
                            <p>{{$service->description}}</p>
                            <span class="price">{{$service->sell_price}}}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- CONTACT SECTION -->

<!-- <section class="contact-section" id="contact-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 sm-padding">
                <div class="contact-info">
                    <h2>
                        Get in touch with us &
                        <br>send us message today!
                    </h2>
                    <p>
                        Saasbiz is a different kind of architecture practice. Founded by LoganCee in 1991, we’re an employee-owned firm pursuing a democratic design process that values everyone’s input.
                    </p>
                    <h3>
                        198 West 21th Street, Suite 721
                        <br>
                        New York, NY 10010
                    </h3>
                    <h4>
                        <span style="font-weight: bold">Email:</span>
                        Dynamiclayers.Net
                        <br>
                        <span style="font-weight: bold">Phone:</span>
                        +88 (0) 101 0000 000
                        <br>
                        <span style="font-weight: bold">Fax:</span>
                        +88 (0) 202 0000 001
                    </h4>
                </div>
            </div>
            <div class="col-lg-6 sm-padding">
                <div class="contact-form">
                    <div id="contact_ajax_form" class="contactForm">
                        <div class="form-group colum-row row">
                            <div class="col-sm-6">
                                <input type="text" id="contact_name" name="name" class="form-control" placeholder="Name">
                            </div>
                            <div class="col-sm-6">
                                <input type="email" id="contact_email" name="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="text" id="contact_subject" name="subject" class="form-control" placeholder="Subject">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <textarea id="contact_message" name="message" cols="30" rows="5" class="form-control message" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button id="contact_send" class="default_btn">Send Message</button>
                            </div>
                        </div>
                        <img src="{{asset('Design/images/ajax_loader_gif.gif')}}" id="contact_ajax_loader" style="display: none">
                        <div id="contact_status_message"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- WIDGET SECTION / FOOTER -->

<section class="widget_section" style="text-align:right">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="footer_widget">
                    <img src="{{asset('Design/images/barbershop_logo.png')}}" alt="Brand">
                    <p>
                        تم إنشاء صالون الحلاقة الخاص بنا للرجال الذين يقدرون الجودة الممتازة والوقت والمظهر الخالي من العيوب.
                    </p>
                    <ul class="widget_social">
                        <li><a href="#" data-toggle="tooltip" title="Facebook"><i class="fab fa-facebook-f fa-2x"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="Twitter"><i class="fab fa-twitter fa-2x"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="Instagram"><i class="fab fa-instagram fa-2x"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="LinkedIn"><i class="fab fa-linkedin fa-2x"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="Google+"><i class="fab fa-google-plus-g fa-2x"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="footer_widget">
                    <h3>المقر الرئيسي</h3>
                    <p>
                        المعادى، ش 9 بجوار مأكولات الدمشقى
                    </p>
                    <p>
                        جهات الأتصال
                        <br>
                        (+123) 456 789 101
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="footer_widget">
                    <h3>
                        مواعيد العمل
                    </h3>
                    <ul class="opening_time">
                        <li>Monday - Friday 11:30am - 2:008pm</li>
                        <li>Monday - Friday 11:30am - 2:008pm</li>
                        <li>Monday - Friday 11:30am - 2:008pm</li>
                        <li>Monday - Friday 11:30am - 2:008pm</li>
                    </ul>
                </div>
            </div>
            <!-- <div class="col-lg-3 col-md-6">
                <div class="footer_widget">
                    <h3>Subscribe to our contents</h3>
                    <div class="subscribe_form">
                        <form action="#" class="subscribe_form" novalidate="true">
                            <input type="email" name="EMAIL" id="subs-email" class="form_input" placeholder="Email Address...">
                            <button type="submit" class="submit">SUBSCRIBE</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    // Create the Scroll-to-Top Button Functionality
document.addEventListener("DOMContentLoaded", function () {
    const scrollToTopBtn = document.getElementById("scroll-top");

    // Show or hide the button based on scroll position
    window.addEventListener("scroll", function () {
        if (window.scrollY > 200) {
            scrollToTopBtn.style.display = "block";
        } else {
            scrollToTopBtn.style.display = "none";
        }
    });

    // Scroll to top when the button is clicked
    scrollToTopBtn.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth", // Smooth scrolling effect
        });
    });
});
</script>
@endpush