@extends('layouts.home')
@section('css')
@endsection('css')
@section('content')
    <div>


        <section id="blog" class="padd-80 clearfix blog-content bg-color">
            <div class="container">
                <div class="row">
                    <div class="row-centered">
                        <div class="col-centered col-lg-7 col-12 col-md-7">

                            <h2 class="title-h2">بلاگ ما</h2>

                            <p class="font-p mg-tp-30 mg-bt-60">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت
                                چاپ و
                                با استفاده از طراحان گرافیک است.</p>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($blogs as $blog)
                            <div class="col-md-4 col-lg-4 col-12">
                                <br>
                                <div class="blog-item">

                                    <div class="top-blog">
                                        <img src="{{'blog/'.$blog->image}}" style="height: 70px;width: 70px" alt="">

                                        <div class="top-blog-info">

                                            <span>{{$blog->title}}</span>
                                            <small>{{\Morilog\Jalali\Jalalian::forge($blog->created_at->todateString())->format('Y-m-d')}}</small>

                                        </div>
                                    </div>

                                    <h3>{{$blog->little_body}} </h3>

                                    <a href="/blog/{{$blog->id}}"><i class="arrow_left"></i></a>


                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!--blog-->
        <!--sponsors clients-->

        <section id="sponsors" class="pd-tp-60 pd-bt-40 ">

            <!--container-->

            <div class="container">
                <div class="row">

                    <div class="row-centered">
                        <div class="col-centered col-lg-12 col-md-12">

                            <div class="client-slider ">

                                <div class="item ">
                                    <img src="assets_landing/images/clients/logo1.png" class="img-responsive " alt=" "
                                         title=" ">

                                </div>
                                <div class="item ">
                                    <img src="assets_landing/images/clients/logo2.png" class="img-responsive " alt=" "
                                         title=" ">

                                </div>

                                <div class="item ">

                                    <img src="assets_landing/images/clients/logo3.png" class="img-responsive " alt=" "
                                         title=" ">

                                </div>

                                <div class="item ">
                                    <img src="assets_landing/images/clients/logo4.png" class="img-responsive " alt=" "
                                         title=" ">

                                </div>

                                <div class="item ">

                                    <img src="assets_landing/images/clients/logo5.png" class="img-responsive " alt=" "
                                         title=" ">

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>
        <!--End sponsors clients-->


    </div>

@endsection('content')
