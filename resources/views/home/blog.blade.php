@extends('layouts.home')
@section('css')
@endsection('css')
@section('content')
    <div>
        <div class="section-title  bg-blog-section" style="background-image: url({{'/blog/'.$row->image}});">
            <div class="container">
                <div class="row-centered">
                    <div class="col-centered col-lg-7">
                        <span class="label red-label">{{$row->title}}</span>
                        {{--                        <img src="{{'/blog/'.$row->image}}" alt="">--}}

                        <h2 class="title-h2">{{$row->little_body}} </h2>

                        <ul class="meta-post">
                            <li><i class="icon_profile"></i><strong>توسط
                                    {{$row->user->name}}
                                </strong></li>
                            <li><i class="icon_clock_alt"></i>
                                {{\Morilog\Jalali\Jalalian::forge($row->created_at->todateString())->format('Y-m-d')}}
                            </li>
                            {{--                            <li><i class=" icon_comment_alt"></i><a href="#">0 دیدگاه</a></li>--}}
                            {{--                            <li><i class="icon_ribbon_alt"></i> 323 بازدید</li>--}}
                        </ul>


                    </div>
                </div>
            </div>

        </div>

        <!-- section title  -->


        <!-- بلاگ content -->

        <div class="blog-single-post padd-80">

            <!-- container -->

            <div class="container">

                <div class="row">

                    <div class="row-centered">
                        <div class="col-centered col-lg-9">
                            <span class="text-right">
                                {!! $row->body !!}
                            </span>
                            <hr>

                            <div class=" clearfix meta-info">

                                <div class="tags-meta float-right">

                                    <ul>
                                        @foreach($row->files as $file)
                                            <li><a href="/files/download/{{$file->id}}" rel="tag">
                                                    دانلود
                                                    {{$file->title}}</a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>


                            <!--share-->


                                <div class="share-post float-left">

                                    <strong>اشتراک گذاری:</strong>
                                    <a href=""><i class="social_facebook"></i></a>
                                    <a href=""><i class="social_twitter"></i></a>
                                    <a href=""><i class="social_linkedin"></i></a>
                                    <a href=""><i class="social_pinterest"></i></a>
                                </div>

                                <!--share-->

                            </div>


                        </div>


                    </div>

                </div>
                <!-- container -->
            </div>

        </div>

    </div>
    </div>

@endsection('content')
