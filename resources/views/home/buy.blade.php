@extends('layouts.home')
@section('css')

@endsection('css')
@section('content')
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="d-flex flex-row">
            <div class="p-2">نام محصول :{{$row->title}}</div>
            <div class="p-2">قیمت:{{number_format($row->price)}}ریال</div>
        </div>


        <div class="row">


            <div class="col-md-12 col-lg-12 col-12">
                <form class="form-quote" action="/pay" method="post">
                    @csrf
                    <input hidden name="product_id" value="{{$row->id}}">
                    <div class="form-row">
                        <div class="form-group pd-rg-0 col-md-3 col-lg-3">

                            <div class="">
                                <input @if(auth()->user()) value="{{auth()->user()->name}}" @endif name="name" required type="" class="form-control" placeholder="نام خود را وارد کنید">

                            </div>
                        </div>
                        <div class="form-group pd-rg-0 col-md-2 col-lg-3">

                            <div class="">
                                <input @if(auth()->user()) value="{{auth()->user()->mobile}}" @endif name="mobile" required type="" class="form-control" placeholder="شماره موبایل خود را وارد کنید">

                            </div>
                        </div>
                        <div class="form-group pd-rg-0 col-md-2 col-lg-3">

                            <div class="">
                                <input name="email" type="" class="form-control" placeholder="ایمیل خود را وارد کنید">

                            </div>
                        </div>
                        <div class="form-group pd-rg-0 col-md-2 col-lg-2">

                            <div class="">
                                <input name="postal_code" required type="" class="form-control" placeholder="کد پستی  را وارد کنید">

                            </div>
                        </div>
                        <div class="form-group pd-rg-0 col-md-1 col-lg-1">

                            <div class="">
                                <input name="city" required class="form-control" placeholder="شهر ">

                            </div>
                        </div>
                        <div class="form-group pd-rg-0 col-md-3 col-lg-12">

                            <div class="">
                                <br>
                                <input name="address" required class="form-control" placeholder="آدرس خود را وارد کنید">

                            </div>
                        </div>
                        <div class="form-group pd-rg-0 col-md-3 col-lg-12">

                            <div class="">
                                <br>
                                <button class="btn btn-block btn-info">ثبت و پرداخت</button>

                            </div>
                        </div>


                    </div>

                </form>
            </div>
        </div>
        <br>
    </div>

@endsection('content')
