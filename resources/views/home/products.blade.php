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
                                    <a href="/buy/{{$row->id}}" class="post-overlay-img">
                                        <img src="{{'/product/'.$row->image}}" alt="">
                                        <span class="label green-label" style="font-size: 14px">{{$row->title}}</span>
                                    </a>
                                    <div class="post-overlay-content">
                                        <span>{{number_format($row->price)}}
                                        ریال
                                        </span>
                                        @if($row->remaining>0)
                                            موجود
                                        @else
                                            ناموجود
                                        @endif
                                        <h2>
                                            <a href="/buy/{{$row->id}}">{{$row->little_body}}</a>
                                        </h2>
                                        <a href="/buy/{{$row->id}}">
                                            <button class="btn btn-block btn-sm btn-outline-info btn-rounded"
                                                    style="font-size: 20px">
                                                خرید
                                            </button>
                                        </a>
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
