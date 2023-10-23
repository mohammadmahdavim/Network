@extends('layouts.admin')
@section('css')
@endsection('css')
@section('script')

@endsection('script')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3>{{$row->title}}</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">آموزش </a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$row->title}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="m-t-20">
                <h3>
                    {{$row->title}}
                </h3>
                <p>
                    <small class="text-muted">{{$row->created_at->toDateString()}}</small>
                </p>
                <div class="d-flex align-items-center p-l-r-0 m-b-20">
                    <figure class="avatar avatar-sm m-l-15">
                        <span class="avatar-title bg-primary rounded-circle">
                            <img src="">
                        </span>
                    </figure>
                    <div>
                        <h6 class="m-b-0 primary-font">{{$row->user->name}}</h6>
                        <span class="small text-muted">{{$row->user->level->name}}</span>
                    </div>
                </div>
                <div class="text-muted text-right">
                    @foreach($row->files as $file)
                        @if($file->type=='voice')
                            <label>{{$file->title}}</label>
                            <div class="small line-height-20" dir="ltr">
                                <audio controls>
                                    <source src="/files/{{$file->file}}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                        @else
                            <a href="/files/download/{{$file->id}}"
                               class="btn btn-light text-right align-items-center justify-content-center m-l-10 m-b-20">
                                <i class="fa fa-file-o font-size-25 m-l-15"></i>
                                <div class="small line-height-20" dir="ltr">
                                    <div>{{$file->title}}</div>
                                </div>
                            </a>
                        @endif

                    @endforeach

                </div>
                <div class="read-mail-body">
                    {!! $row->body !!}

                </div>
            </div>
        </div>
    </div>



@endsection('content')


