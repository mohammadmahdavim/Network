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


        <div class="row">

            <h4> ارتباط با ما :</h4>
            <div class="col-md-12 col-lg-12 col-12">
                <form class="form-quote" action="/home/contact_store" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group pd-rg-0 col-md-3 col-lg-6">

                            <div class="">
                                <input name="name" required type="" class="form-control"
                                       placeholder="نام و نام خانوداگی خود را وارد کنید.">

                            </div>
                        </div>
                        <div class="form-group pd-rg-0 col-md-2 col-lg-6">

                            <div class="">
                                <input name="mobile" required type="" class="form-control"
                                       placeholder="شماره موبایل خود را وارد کنید.">

                            </div>
                        </div>
                        <div class="form-group pd-rg-0 col-md-3 col-lg-12">

                            <div class="">
                                <br>
                                <button class="btn btn-block btn-info">ثبت</button>

                            </div>
                        </div>


                    </div>

                </form>
            </div>
        </div>
        <br>
    </div>

@endsection('content')
