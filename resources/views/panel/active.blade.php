<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- begin::global styles -->
    <link rel="stylesheet" href="/assets/vendors/bundle.css" type="text/css">
    <!-- end::global styles -->

    <!-- begin::custom styles -->
    <link rel="stylesheet" href="/assets/css/app.css" type="text/css">
    <!-- end::custom styles -->

    <!-- begin::favicon -->
    <!-- end::favicon -->

    <!-- begin::theme color -->
    <meta name="theme-color" content="#3f51b5"/>
    <!-- end::theme color -->

</head>
<body class="bg-white h-100-vh p-t-0">

<!-- begin::page loader-->
<div class="page-loader">
    <div class="spinner-border"></div>
    <span>در حال بارگذاری ...</span>
</div>
<!-- end::page loader -->

<div class="container h-100-vh">
    <div class="row align-items-center h-100-vh">
        <div class="col-lg-6 d-none d-lg-block p-t-b-25">
            <img class="img-fluid" src="/assets/media/svg/recover-password.svg" alt="...">
        </div>

        <div class="col-lg-4 offset-lg-1 p-t-25 p-b-10">


            <h3>کاربر عزیز {{auth()->user()->name}}</h3>
            <p>لطفا کد پیامک شده را وارد کنید.</p>

            <form method="POST" action="/check_active">
                @csrf
                @include('include.errors')

                <div class="form-group row">

                    <div class="col-md-12">
                        <input id="code" type=""
                               class="form-control form-control-lg{{ $errors->has('code') ? ' is-invalid' : '' }}"
                               name="code" required autofocus placeholder="کد">
                    </div>
                </div>


                <div class="form-group row mb-0">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-lg btn-block btn-uppercase mb-4">ارسال</button>

                    </div>
                </div>

            </form>
            <p class="text-right"><a href="/send_code">
                    <button class="btn btn-info"> ارسال مجدد کد</button>
                </a>
            <form action="/logout" method="post">
                @csrf
                <button type="submit" class="btn btn-warning">انصراف</button>
            </form>
            </p>

        </div>
    </div>
</div>
</body>
<script src="/js/sweetalert.min.js"></script>
@include('sweet::alert')
<!-- begin::global scripts -->
<script src="/assets/vendors/bundle.js"></script>
<!-- end::global scripts -->

<!-- begin::custom scripts -->
<script src="/assets/js/app.js"></script>
<!-- end::custom scripts -->


</html>