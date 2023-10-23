@extends('layouts.admin')
@section('css')
@endsection('css')
@section('script')
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
@endsection('script')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>پروفایل</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">ارتباط با ما</a></li>
                    <li class="breadcrumb-item active" aria-current="page">پروفایل</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-header">
            اطلاعات
        </div>
        <div class="card-body">
            <form method="post" action="/profile_update">
                @csrf
                @include('include.errors')

                <div class="row">
                    <div class="col-md-3">
                        <input name="name" class="form-control" value="{{$user->name}}" required>
                    </div>
                    <div class="col-md-3">
                        <input name="mobile" class="form-control" value="{{$user->mobile}}" required>

                    </div>
{{--                    <div class="col-md-3">--}}
{{--                        <button class="btn btn-info">ثبت</button>--}}
{{--                    </div>--}}
                </div>
            </form>
        </div>
    </div>
    @if($user->level_id==1)
        <div class="card">
            <div class="card-header">
                کد معرف خود را وارد کنید.
            </div>
            <div class="card-body">
                <form method="post" action="/insert_code">
                    @csrf
                    @include('include.errors')
                <div class="row">
                    <div class="col-md-3">
                        <input name="code" value="{{old('code')}}" class="form-control" placeholder="کد معرف خود را وارد کنید." required>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-info">ثبت</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-header">
                کد های دعوت شما
            </div>
            <div class="card-body">
                <ol>
                    @foreach($user->codes as $code)
                        <li @if($code->used==1) style="color: red" @else style="color: black"  @endif>
                            {{$code->identification->code}}
                            @if($code->used==1)
                                <span style="color: red">استفاده شده</span>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    @endif

    <script src="/js/sweetalert.min.js"></script>

    @include('sweet::alert')

@endsection('content')


