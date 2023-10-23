@extends('layouts.home')
@section('css')
@endsection('css')
@section('content')
    <br>
    <br>
    <section id="blog" class="pd-tp-40 pd-bt-80">
        <div class="container">
            <div class="row">
                <div class="blog-main-content col-md-12">
                    <!-- blog-list -->

                    <section class="blog-list row">


                        @foreach($rows as $row)
                            <div class="col-md-4 col-lg-4 col-12">
                                <br>
                                <div class="post-overlay big-post-overlay round-post mag-bt-0">
                                    <a href="/blog/{{$row->id}}" class="post-overlay-img">
                                        <img src="{{'/blog/'.$row->image}}" alt="">
                                        <span class="label green-label">{{$row->title}}</span>
                                    </a>

                                    <div class="post-overlay-content">

                                        <span>{{\Morilog\Jalali\Jalalian::forge($row->created_at->todateString())->format('Y-m-d')}}</span>
                                        <h2>
                                            <a href="/blog/{{$row->id}}">{{$row->little_body}}</a>

                                        </h2>

                                    </div>


                                </div>

                            </div>

                        @endforeach


                    </section>


                </div>
            </div>
            <br>
        {!! $rows->withQueryString()->links("pagination::bootstrap-4") !!}

    </section>

@endsection('content')
