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
            <h3>لیست</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">آموزش ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">لیست</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')

    <div class="row">
        @foreach($rows as $row)
            <a href="/learns/{{$row->id}}">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">{{$row->title}}</div>
                        <div class="card-body">
                            <figure>
                                <img @if($row->image) src="/learn/{{$row->image}}"
                                     @else src="/network-marketing.png" @endif class="card-img" width="300"
                                     height="300" alt="...">
                            </figure>
                            <p class="card-text">
                                {!!  substr(strip_tags($row->body), 0, 150) !!}
                                ...
                            </p>

                            @foreach($row->files as $file)
                                @if($file->type=='voice')
                                    <label>{{$file->title}}</label>
                                    <div class="small line-height-20" dir="ltr" >
                                        <audio controls>
                                            <source src="/files/{{$file->file}}" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                    </div>
                                    <br>
                                @endif
                            @endforeach
                            <a href="/learns/{{$row->id}}" class="btn btn-primary" style="color: white">بیشتر بخوانید</a>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach


    </div>
    <br>
    {!! $rows->withQueryString()->links("pagination::bootstrap-4") !!}
    <!--<div class="card">-->
    <!--    <div class="card-body">-->


    <!--        <div class="">-->
    <!--            <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">-->
    <!--                <thead>-->
    <!--                <tr class="success" style="text-align: center">-->
    <!--                    <th>شمارنده</th>-->
    <!--                    <th>تصویر</th>-->
    <!--                    <th>عنوان</th>-->
    <!--                    <th>فایل ها</th>-->
    <!--                    <th>عملیات</th>-->
    <!--                </tr>-->
    <!--                </thead>-->
    <!--                <tbody>-->
    <!--                <tr>-->
    <!--                    <?php $idn = 1; ?>-->
    <!--                    @foreach($rows as $row)-->
    <!--                        <td style="text-align: center">{{$idn}}</td>-->
    <!--                        <td style="text-align: center">-->
    <!--                            <img @if($row->image) src="/learn/{{$row->image}}"-->
    <!--                                 @else src="\assets\media\image\dark-logo.png" @endif width="50" height="50"-->
    <!--                                 class="rounded">-->
    <!--                        </td>-->
    <!--                        <td style="text-align: center">{{$row->title}}</td>-->
    <!--                        <td style="text-align: center">-->
    <!--                            @foreach($row->files as $file)-->
    <!--                                @if($file->type=='voice')-->
    <!--                                    <label>{{$file->title}}</label>-->
    <!--                                    <div class="small line-height-20" dir="ltr">-->
    <!--                                        <audio controls>-->
    <!--                                            <source src="/files/{{$file->file}}" type="audio/mpeg">-->
    <!--                                            Your browser does not support the audio element.-->
    <!--                                        </audio>-->
    <!--                                    </div>-->
    <!--                                @else-->
    <!--                                    <a href="/files/download/{{$file->id}}"-->
    <!--                                       class="btn btn-light text-right align-items-center justify-content-center m-l-10 m-b-20">-->
    <!--                                        <i class="fa fa-file-o font-size-25 m-l-15"></i>-->
    <!--                                        <div class="small line-height-20" dir="ltr">-->
    <!--                                            <div>{{$file->title}}</div>-->
    <!--                                        </div>-->
    <!--                                    </a>-->
    <!--                                @endif-->

    <!--                            @endforeach-->

    <!--                        </td>-->
    <!--                        <td style="text-align: center">-->
    <!--                            <a href="/learns/{{$row->id}}">-->
    <!--                                <button class="btn btn-primary">نمایش</button>-->
    <!--                            </a>-->
    <!--                        </td>-->
    <!--                </tr>-->
    <!--                <?php $idn = $idn + 1 ?>-->
    <!--                @endforeach-->
    <!--                </tbody>-->
    <!--            </table>-->
    <!--        </div>-->
    <!--        {!! $rows->withQueryString()->links("pagination::bootstrap-4") !!}-->

    <!--    </div>-->
    <!--</div>-->

    <script src="/js/sweetalert.min.js"></script>

    @include('sweet::alert')

@endsection('content')
<script>
    function deleteData(id) {
        swal({
            title: "آیا از حذف مطمئن هستید؟",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{  url('/learns/delete/')  }}" + '/' + id,
                        type: "GET",

                        success: function () {
                            swal({
                                title: "حذف با موفقیت انجام شد!",
                                icon: "success",

                            });
                            window.location.reload(true);
                        },
                        error: function () {
                            swal({
                                title: "خطا...",
                                text: data.message,
                                type: 'error',
                                timer: '1500'
                            })

                        }
                    });
                } else {
                    swal("عملیات حذف لغو گردید");
                }
            });

    }

</script>


