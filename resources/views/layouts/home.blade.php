<!DOCTYPE html>
<html lang="en">

<head>
    <!--Metas-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="LeadDigital  Landing page Template">
    <title>کانون نتورک مارکتینگ</title>

    <!--External Stylesheets css-->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/assets_landing/css/bootstrap.min.css">

    <!--elegant icon font -->
    <link rel="stylesheet" href="/assets_landing/css/elegant-icons.css">
    <!--Animate -->
    <link rel="stylesheet" href="/assets_landing/css/animate.css">

    <!-- Slick -carousel-->
    <link rel="stylesheet" href="/assets_landing/css/slick.css">

    <!-- Magnific Popup-->
    <link rel="stylesheet" href="/assets_landing/css/magnific-popup.css">


    <!--Template Stylesheets css-->

    <link rel="stylesheet" href="/assets_landing/css/style.css">
    <link rel="stylesheet" href="/assets_landing/css/responsive.css">
    <link rel="stylesheet" href="/assets_landing/css/rtl.css">

@yield('css')

<!-- Fonts styles -->

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets_landing/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="/assets_landing/images/favicon.png" type="image/x-icon">

    <script src="/assets_landing/js/modernizr.js"></script>


    <!--[if lt IE 9]>
    <script src="/assets_landing/js/html5shiv.min.js"></script>
    <script src="/assets_landing/js/respond.min.js"></script>
    <![endif]-->
</head>


<body data-spy="scroll" data-target=".navbar-default" data-offset="100">


<!-- Page Preloader -->

<div id="loading-page">
    <div id="loading-center-page">
        <div id="loading-center-absolute">

            <div class="loader"></div>
        </div>
    </div>

</div>

<!-- Page Preloader -->

<!-- Page Content -->
<div class="warpper clearfix">


    <!-- Header -->
    <header class="navbar-header">

        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">

                <a class="navbar-brand" href="/home"> <img src="/assets_landing/images/logo-icon.svg" alt="">
                    <span>کانون نتورک مارکتینگ</span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon  icon_menu"></span>
                </button>

                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a data-scroll="" class="nav-link section-scroll" href="/home">خانه</a>
                        </li>
                        <li class="nav-item">
                            <a data-scroll="" class="nav-link section-scroll" href="/home/about">درباره ما</a>
                        </li>

                        <li class="nav-item">
                            <a data-scroll="" class="nav-link section-scroll" href="/home/contact">ارتباط با ما</a>
                        </li>
                        <!--
                                                <li class="nav-item">
                                                    <a data-scroll="" class="nav-link section-scroll" href="/home/develop">توسعه فردی</a>
                                                </li>

                                                <li class="nav-item">
                                                    <a data-scroll="" class="nav-link section-scroll" href="/home/map">نقشه راه یادگیری</a>
                                                </li>
                        -->
                        <li class="nav-item">
                            <a data-scroll="" class="nav-link section-scroll" href="/home/blogs">وبلاگ</a>
                        </li>
                        <li>
                            <a data-scroll="" href="/home/products" class="nav-link section-scroll">فروشگاه</a>
                        </li>
                        {{--                        <li>--}}
                        {{--                            <a data-scroll="" href="blog.html" class="nav-link section-scroll">پرسش های متداول</a>--}}
                        {{--                        </li>--}}

                        <li>
                            <div class="connect-block"><a href="/login" class="btn btn-blue">

                                    @if(auth()->user())
                                        {{auth()->user()->name}}
                                    @else
                                        ورود/ ثبت نام
                                    @endif
                                </a>
                            </div>

                        </li>

                    </ul>

                </div>
            </div>
        </nav>


    </header>
    @yield('content')
</div>


<!--End page cotnent-->

<!--Footer-->

<footer class="footer">

    <div class="footer-warpper">


        <!--Request quote-->

        <section class="padd-40 bg-color-2">

            <div class="container">

                <div class="row">


                    <div class="col-md-5 col-lg-5 col-12">
                        <div class="quote-bloc">

                            <h3> دریاقت اخبار و اطلاع از آخرین ها </h3>
                            <p>از طرف آکانون شماره یک نتورک مارکتینگ جهان</p>

                        </div>


                    </div>

                    <div class="col-md-7 col-lg-7 col-12">
                        <form class="form-quote">

                            <div class="form-row">
                                <div class="form-group pd-rg-0 col-md-11 col-lg-11">

                                    <div class="input-icon">
                                        <span class="icon_globe_alt"></span>
                                        <input type="email" class="form-control" placeholder="ایمیل خود را وارد کنید">

                                        <button class="btn btn-blue-1">بررسی کن</button>
                                    </div>
                                </div>


                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </section>
        <!--Request quote-->


        <div class="footer-top">
            <div class="container">

                <div class="footer-bottom-content clearfix">

                    <div class="row">

                        <div class="col-lg-4 col-md-4">


                            <div class="logo-footer">
                                <a class="navbar-brand" href="index.html"> <img
                                        src="/assets_landing/images/logo-icon.svg"
                                        alt=""><span>کانون نتورک مارکتینگ</span></a>

                            </div>
                            <div class="text-footer">
                                <p>
                                    برای ایجاد نگاهی نو به تجارت پر از عشق نتورک مارکتینگ

                                </p>
                            </div>

                            <!-- Newsletter -->
                            <div class="newsletter-block clearfix">


                                <div class="subscribe-form">

                                    <form action="#" method="get" class="subscribe-mail">
                                        <div class="form-group ">
                                            <input type="email" class="form-control email-input"
                                                   placeholder="ایمیل خود را وارد کنید">
                                            <button type="submit" class="btn btn-subscribe"><i
                                                    class="arrow_left_alt"></i></button>
                                        </div>
                                        <p class="error-message"></p>
                                        <p class="sucess-message"></p>

                                    </form>
                                </div>
                            </div>
                            <!-- Newsletter -->


                            <ul class="list-social list-inline">
                                <li>
                                    <a href="#">
                                        <i class="social_facebook "></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="social_twitter "></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="social_googleplus "></i>
                                    </a>
                                </li>


                            </ul>


                        </div>

                        <!--
                                                <div class="col-lg-3 col-md-3">

                                                    <h5>منو</h5>

                                                    <ul class="list-menu">
                                                        <li>
                                                            <a href="#">خانه </a>
                                                        </li>

                                                        <li>
                                                            <a href="#">درباره</a>
                                                        </li>

                                                        <li>
                                                            <a href="#">ارتباط با ما</a>
                                                        </li>

                                                        <li>
                                                            <a href="#">توسعه فردی</a>
                                                        </li>

                                                        <li>
                                                            <a href="#">وبلاگ</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">فروشگاه</a>
                                                        </li>


                                                    </ul>


                                                </div>
                        -->

                        <div class="col-lg-4 col-md-4">

                            <h5>پیوند های مفید</h5>
                            <ul class="list-menu">
                                <!--
                                <li>
                                    <a href="#">چگونه کار می کند </a>
                                </li>
                                <li>
                                    <a href="#">شرایط خدمات</a>
                                </li>


                                <li>
                                    <a href="#">حریم خصوصی</a>
                                </li>

                                <li>
                                    <a href="#">شرایط عمومی</a>
                                </li>
                                <li>
                                    <a href="#">سوالات متداول</a>
                                </li>
-->

                            </ul>


                        </div>

                        <div class="col-lg-4 col-md-4">

                            <h5>اطلاعات تماس</h5>
                            <ul class="list-menu contact-list">
                                <li>
                                    ایران، تهران
                                </li>
                                <li>
                                    info@network-marketing.center
                                </li>

                                <li>09128828588</li>

                            </ul>


                        </div>

                    </div>
                </div>


            </div>
        </div>

        <div class="footer-bottom">

            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <!-- COPYRIGHT TEXT -->

                        <div class="copyright text-center">
                            <p>
                                نمام حقوق این سایت محفوظ می باشد و متعلق به کانون نتورک مارکتینگ می باشد.
                            </p>
                        </div>
                        <!-- COPYRIGHT TEXT -->
                    </div>


                </div>
            </div>

        </div>
    </div>

</footer>

<!--Footer -->


<!-- jQuery -->
<script src="/assets_landing/js/jquery-2.1.1.min.js"></script>

<!-- Bootstrap Plugins -->
<script src="/assets_landing/js/bootstrap.min.js"></script>

<!-- Template Plugins -->
<script src="/assets_landing/js/jquery.easing.js"></script>
<script src="/assets_landing/js/wow.min.js "></script>
<script src="/assets_landing/js/magnific-popup.min.js "></script>
<script src="/assets_landing/js/jquery.scrollUp.min.js"></script>
<script src="/assets_landing/js/jquery.ajaxchimp.min.js"></script>
<script src="/assets_landing/js/slick.min.js"></script>

<!-- Main js -->
<script src="/assets_landing/js/main.js"></script>
<script src="/js/sweetalert.min.js"></script>
@include('sweet::alert')
@yield('script')

</body>

</html>
