@extends('layouts.admin')
@section('css')
    <!-- begin::select2 -->
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
    <!-- end::select2 -->
@endsection('css')
@section('script')
    <!-- begin::CKEditor -->
    <script src="/assets/vendors/ckeditor/ckeditor.js"></script>
    <script src="/assets/js/examples/ckeditor.js"></script>
    <!-- end::CKEditor -->

    <!-- begin::sweet alert demo -->
    <script src="/js/sweetalert.min.js"></script>
    {{--    @include('sweet::alert')--}}
    <!-- begin::sweet alert demo -->
@endsection('script')
@section('navbar')


@endsection('navbar')
@section('sidebar')
@endsection('sidebar')

@section('header')
    <div class="page-header">
        <div>
            <h3>ایجاد</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">آزمون ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="/exams" method="post" autocomplete="off" enctype="multipart/form-data">

                {{csrf_field()}}
                @include('include.errors')

                <div style="text-align: center">
                    <h4 class="panel-title" style="padding-top: 40px;font-size: large;font-family: 'B Titr' ">
                        ایجاد آزمون جدید
                    </h4>
                </div>
                <div class="panel-heading">
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">


                    <div class=" col-md-3">
                        <label>عنوان آزمون </label>
                        <br>
                        <input style="text-align: center" type="text" id="title" name="title"
                               class="form-control" value="{{old('title')}}" required>
                    </div>
                    <div class=" col-md-3">
                        <label>زمان آزمون به دقیقه </label>
                        <br>
                        <input style="text-align: center" type="number" id="time" name="time"
                               class="form-control" value="{{old('time')}}" required>
                    </div>
                    <div class=" col-md-3">
                        <label>سطح آزمون </label>
                        <br>
                        <select name="level_id" class="form-control">
                            @foreach($levels as $level)
                                <option value="{{$level->id}}">{{$level->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{--                    <div class=" col-md-3">--}}

                    {{--                        <label>زمان آزمون</label>--}}
                    {{--                        <input style="text-align: center" class="form-control" type="number" required name="time"--}}
                    {{--                               placeholder="زمان آزمون را به دقیقه وارد نمایید." value="{{old('time')}}">--}}
                    {{--                    </div>--}}
                    <div class=" col-md-3">

                        <label>تعداد سوالات</label>
                        <input style="text-align: center" class="form-control" type="number" required
                               name="questions_count" value="{{old('questions_count')}}"
                               placeholder="تعداد سوالی که هر فرد پاسخ می دهد.">
                    </div>
                    <div class="form-group col-md-12">

                        <br>
                        <button class="btn btn-primary btn-lg btn-block" type="submit">ایجاد آزمون
                        </button>

                    </div>

                </div>
            </form>

        </div>
    </div>
@endsection('content')
