<!DOCTYPE html>
<html lang="fa">
<head>
    <style>
        @media (max-width: 767px) {
            .hidden-mobile {
                display: none;
            }
        }
    </style>
    <meta name="_token" content="{{ csrf_token() }}"/>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> کانون نتورک مارکتینگ</title>

    <link href="/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">

    <!-- begin::global styles -->
    <link rel="stylesheet" href="/assets/vendors/bundle.css" type="text/css">
    <!-- end::global styles -->

    <link rel="stylesheet" href="/assets/vendors/swiper/swiper.min.css">

    <!-- begin::custom styles -->
    <link rel="stylesheet" href="/assets/css/app.css" type="text/css">
    <link rel="stylesheet" href="/assets/css/custom.css" type="text/css">
    <!-- end::custom styles -->


    <!-- begin::theme color -->
    <meta name="theme-color" content="#3f51b5"/>
    <!-- end::theme color -->
    @yield('css')

</head>
<body>

<!-- begin::page loader-->
<div class="page-loader text-info">
    <div class="spinner-border"></div>
    <span>در حال بارگذاری ...</span>
</div>
<!-- end::page loader -->

<!-- begin::sidebar -->
<div class="sidebar">
    <ul class="nav nav-pills nav-justified m-b-30" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="messages-tab" data-toggle="pill" href="#messages" role="tab"
               aria-controls="messages" aria-selected="true">
                <i class="fa fa-envelope"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="notifications-tab" data-toggle="pill" href="#notifications" role="tab"
               aria-controls="notifications" aria-selected="false">
                <i class="fa fa-bell"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="settings-tab" data-toggle="pill" href="#settings" role="tab"
               aria-controls="settings" aria-selected="false">
                <i class="ti-settings"></i>
            </a>
        </li>
    </ul>
</div>
<!-- end::sidebar -->

@if(auth()->user()->level_id!='1')
    <div class="side-menu">
        <div class="side-menu-body">
            <ul>
                <li><a class="navbar-brand" href="/panel"><i class="icon ti-home"></i>
                        <span>میز کار (داشبورد)</span></a>
                </li>
                @if(auth()->user()->role=='admin')
                    <li><a href="#"><i class="icon-collaboration"></i> &nbsp &nbsp <span>وبلاگ</span>
                        </a>
                        <ul>
                            <li><a href="/blogs/create">ایجاد</a></li>
                            <li><a href="/blogs">نمایش </a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="icon-collaboration"></i> &nbsp &nbsp <span>فروشگاه</span>
                        </a>
                        <ul>
                            <li><a href="/products/create">ایجاد محصول</a></li>
                            <li><a href="/products">نمایش محصولات</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="icon-collaboration"></i> &nbsp &nbsp <span>گزارشات</span>
                        </a>
                        <ul>
                            <li><a href="/orders">سفارشات</a></li>
                            {{--                    <li><a href="/transactions">پرداخت ها</a></li>--}}
                        </ul>
                    </li>
                @endif
                    <?php
                    $levels = \App\Models\Level::all();
                    ?>
                <li><a href="#"><i class="icon-collaboration"></i> &nbsp &nbsp <span>آموزش ها</span>
                    </a>
                    <ul>
                        @if(auth()->user()->role=='admin')

                            <li><a href="/learns/create">ایجاد آموزش</a></li>
                        @endif
                        <li><a href="/#">نمایش آموزش ها</a>
                            <ul>
                                @if(auth()->user()->role=='admin')

                                    <li>
                                        <a href="/learns">همه ی آموزش ها</a>
                                    </li>
                                @endif

                                @foreach($levels as $level)
                                    {{--                                @if($level->rank>1 and auth()->user()->level_id>=$level->rank)--}}
                                    @if(auth()->user()->level_id>=$level->rank)
                                        <li><a href="/learns_list/{{$level->id}}">{{$level->name}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>

                    </ul>
                </li>
                {{--            <li><a href="#"><i class="icon-collaboration"></i> &nbsp &nbsp <span>کلاس های آنلاین</span>--}}
                {{--                </a>--}}
                {{--                <ul>--}}
                {{--                    @foreach($levels as $level)--}}
                {{--                        <li><a href="/class/{{$level->id}}">{{$level->name}}</a></li>--}}
                {{--                    @endforeach--}}
                {{--                </ul>--}}
                {{--            </li>--}}
                <li><a href="#"><i class="icon-collaboration"></i> &nbsp &nbsp <span>کوییز ها</span>
                    </a>
                    <ul>
                        @if(auth()->user()->role=='admin')

                            <li><a href="/exams/create">ایجاد آزمون</a></li>
                        @endif
                        <li><a href="/#">نمایش آزمون ها</a>
                            <ul>
                                @if(auth()->user()->role=='admin')

                                    <li>
                                        <a href="/exams">همه ی آزمون ها</a>
                                    </li>
                                @endif
                                @foreach($levels as $level)
                                    <li><a href="/exams_list/{{$level->id}}">{{$level->name}}</a></li>
                                @endforeach
                            </ul>

                        </li>
                    </ul>

                </li>
                <li><a href="#"><i class="icon-collaboration"></i> &nbsp &nbsp <span>لیست اسامی</span>
                    </a>
                    <ul>
                        <li><a href="/members/first">اولیه</a></li>
                        <li><a href="/members/bronze">برنزی</a></li>
                        @if(\App\Models\Member::where('author', auth()->user()->id)
                 ->where('status', 'silver')->count()!=0)
                            <li><a href="/members/silver">نقره ای</a></li>

                        @endif
                        @if(\App\Models\Member::where('author', auth()->user()->id)
                ->where('status', 'golden')->count()!=0)
                            <li><a href="/members/golden">طلایی</a></li>
                        @endif
                        @if(\App\Models\Member::where('author', auth()->user()->id)
                            ->where('status', 'final')->count()!=0)
                            <li><a href="/members/final">نهایی</a></li>
                        @endif
                        @if(\App\Models\Member::where('author', auth()->user()->id)
                          ->where('status2', 'second')->count()!=0)
                            <li><a href="/members/second">ثانویه</a></li>
                        @endif
                        @if(\App\Models\Member::where('author', auth()->user()->id)
                          ->where('status2', 'shared')->count()!=0)
                            <li><a href="/members/shared">مشترک</a></li>
                        @endif
                        @if(\App\Models\Member::where('author', auth()->user()->id)
                          ->where('status3', 'invites')->count()!=0)
                            <li><a href="/members/invites">دعوت شده</a></li>
                        @endif
                        @if(\App\Models\Member::where('author', auth()->user()->id)
                           ->where('status3', 'presents')->count()!=0)
                            <li><a href="/members/presents">پرزنت شده</a></li>
                        @endif
                        @if(\App\Models\Member::where('author', auth()->user()->id)
                          ->where('status3', 'presents')->count()!=0)
                            <li><a href="/members/follow_up">پیگیری</a></li>
                        @endif
                    </ul>

                </li>
                @if(auth()->user()->role=='admin')

                    <li>
                        <a href="/users">
                            <i class="icon-collaboration"></i> &nbsp &nbsp
                            لیست افراد
                        </a>
                    </li>
                    <li><a href="/contact">
                            <i class="icon-collaboration"></i> &nbsp &nbsp
                            ارتباط با ما</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>

@endif
<!-- begin::side menu -->
<!-- end::side menu -->

<!-- begin::navbar -->
<nav class="navbar">
    <div class="container-fluid">

        <div class="header-logo">
            <a href="#">
                <img src="/assets/media/image/light-logo.png" alt="...">
                <span class=" d-none d-lg-block">
                    {{auth()->user()->level->name}}
                    عزیز
                    <span style="color: darkred">
                                           {{auth()->user()->name}}

                    </span>
                    به کانون نتورک مارکتینگ خوش آمدید.
                    <br>
                </span>
            </a>

        </div>
        <div class="header-body">
            <ul class="navbar-nav">
                <li class="nav-item dropdown d-none d-lg-block">
                    <a href="#" class="nav-link" data-toggle="dropdown">
                        <i class="fa fa-th-large"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-nav-grid">
                        <div class="dropdown-menu-title">منوی سریع</div>
                        <div class="dropdown-menu-body">
                            <div class="nav-grid">
                                <div class="nav-grid-row">
                                    <a href="#" class="nav-grid-item">
                                        <i class="fa fa-address-book-o"></i>
                                        <span>نرم افزار</span>
                                    </a>
                                    <a href="#" class="nav-grid-item">
                                        <i class="fa fa-envelope-o"></i>
                                        <span>ایمیل</span>
                                    </a>
                                </div>
                                <div class="nav-grid-row">
                                    <a href="#" class="nav-grid-item">
                                        <i class="fa fa-sticky-note"></i>
                                        <span>گفتگو</span>
                                    </a>
                                    <a href="#" class="nav-grid-item">
                                        <i class="fa fa-dashboard"></i>
                                        <span>داشبورد</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>

            <div class="hidden-mobile">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/home" class="nav-link " style="font-size: 14px!important;"
                           data-sidebar-target="#messages">
                            خانه </a>
                    </li>
                    <li class="nav-item">
                        <a href="/home/about" class="nav-link " style="font-size: 14px!important;"
                           data-sidebar-target="#messages">
                            درباره ما
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/home/contact" class="nav-link " style="font-size: 14px!important;"
                           data-sidebar-target="#messages">
                            ارتباط با ما
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/home/blogs" class="nav-link " style="font-size: 14px!important;"
                           data-sidebar-target="#messages">
                            آموزش عمومی
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/learns_list_level" class="nav-link " style="font-size: 14px!important;"
                           data-sidebar-target="#messages">
                            آموزش تخصصی
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/home/products" class="nav-link " style="font-size: 14px!important;"
                           data-sidebar-target="#messages">
                            فروشگاه
                        </a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="nav-link nav-link-notify sidebar-open" data-sidebar-target="#messages">
                        <i class="fa fa-envelope"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-link-notify sidebar-open" data-sidebar-target="#notifications">
                        <i class="fa fa-bell"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" data-toggle="dropdown">
                        <figure class="avatar avatar-sm avatar-state-success">
                            <img class="rounded-circle" src="/assets/media/image/avatar.jpg" alt="...">
                        </figure>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="/profile" class="dropdown-item">
                            {{auth()->user()->name}}
                            ( {{auth()->user()->level->name}}
                            )
                        </a>
                        <a href="/profile" class="dropdown-item">پروفایل</a>
                        <a href="#" data-sidebar-target="#settings" class="sidebar-open dropdown-item">تنظیمات</a>
                        <div class="dropdown-divider"></div>
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="text-danger dropdown-item">خروج</button>
                        </form>
                    </div>
                </li>
                <li class="nav-item d-lg-none d-sm-block">
                    <a href="#" class="nav-link side-menu-open">
                        <i class="ti-menu"></i>
                    </a>

                </li>
            </ul>
        </div>

    </div>
</nav>
<!-- end::navbar -->

<!-- begin::main content -->
<main class="main-content">

    <div class="container-fluid">

        <!-- begin::page header -->
        @yield('header')

        <!-- end::page header -->
        @yield('content')
    </div>

</main>
<!-- end::main content -->

<!-- begin::global scripts -->


<script src="/assets/vendors/bundle.js"></script>
<!-- end::global scripts -->

<!-- begin::custom scripts -->
<script src="/assets/js/custom.js"></script>
<script src="/assets/js/app.js"></script>
<!-- begin::favicon -->
<link rel="shortcut icon" href="/assets/media/image/favicon.png">
<!-- end::favicon -->
<!-- end::custom scripts -->


@yield('script')
<script>
    function change(id, obj, name, column) {
        var $input = $(obj);
        var type = 0;
        if ($input.prop('checked')) {
            var type = 1;
        }

        $.ajaxSetup({

            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url: '{{url('/members/change_type')}}',
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                type: type,
                name: name,
                column: column,
                "id": id
            },
            success: function () {
                swal({
                    title: "عملیات انجام شد.",
                    icon: "success",

                });
                location.reload();

            }
        })


    }
</script>

</body>
</html>
