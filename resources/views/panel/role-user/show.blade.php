@extends('layouts.admin')
@section('css')
    <!-- begin::dataTable -->

    <!-- end::dataTable -->
    <style>
        .my-custom-scrollbar {
            position: relative;
            height: 500px;
            overflow: auto;
        }

        .table-wrapper-scroll-y {
            display: block;
        }
    </style>
@endsection('css')
@section('script')

    <script type="text/javascript" src="/assets/jss/js/plugins/forms/selects/bootstrap_multiselect.js"></script>

    <script type="text/javascript" src="/assets/jss/js/pages/form_multiselect.js"></script>

    <!-- end::dataTable -->

    <!-- begin::sweet alert demo -->
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::sweet alert demo -->
@endsection('script')
@section('navbar')


@endsection('navbar')
@section('sidebar')
@endsection('sidebar')

@section('header')
    <div class="page-header">
        <div>
            <h3>نمایش</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/home">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">مدیریت اعضای سایت</a></li>
                    <li class="breadcrumb-item active" aria-current="page">نمایش سمت</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <div class="table-responsive">
                    <a href="/admin/users/roles">
                        <div class="btn btn-outline-danger ">

                            ایجاد سمت
                        </div>
                    </a>
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">

                        <table class="table" id="myTable">
                            <thead>
                            <tr class="info" style="text-align: center">
                                <th> عکس</th>
                                <th>نام و نام خانوادگی</th>
                                <th> نقش ها</th>
                            </tr>
                            </thead>
                            <tbody>
                            @include('include.errors')
                            @foreach($users as $user )
                                <tr>
                                    <td>
                                        <img @if($row->image) src="/user/{{$row->image}}" @else src="man.png"  @endif width="50" height="50" class="rounded">

                                    </td>
                                    <td style="text-align: center">
                                        {{$user->l_name}} - {{$user->f_name}}
                                    </td>
                                    <td style="text-align: center">
                                        @foreach($user->roles as $role)

                                            <span class="btn btn-info btn-rounded ">  {{$role->label}}</span>
                                        @endforeach
                                    </td>

                                </tr>
                            @endforeach
                            <script src="/js/sweetalert.min.js"></script>
                            @include('sweet::alert')
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection('content')
