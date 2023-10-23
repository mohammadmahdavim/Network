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
                    <li class="breadcrumb-item"><a href="#">آزمون ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">لیست</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            @if($row)
            @if($row->answers!='[]')
                <div>
                    <div class="d-flex flex-row">
                        <div class="p-2">تعداد سوالات:
                            <?php
                            $countQuestion = count($row->questions);
                            $correctQuestion = count($row->answers->where('true', 1));
                            ?>
                            <b>{{$countQuestion}}</b>
                        </div>
                        <div class="p-2">تعداد پاسخ درست:
                            <b>{{$correctQuestion}}</b>
                        </div>
                        <div class="p-2">
                            نمره از ۱۰۰:
                            @if($correctQuestion==0)
                                <b>0</b>
                            @else
<b>                                {{round($correctQuestion/$countQuestion,'2')*100}}
</b>                                @endif
                        </div>
                    </div>
                </div>
            @endif
            @endif
            <div class="">
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>عنوان</th>
                        <th>سطح</th>
                        <th>زمان</th>
                        <th>تاریخ ایجاد</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($row)

                        <tr>
                        <td style="text-align: center">{{$row->title}}</td>
                        <td style="text-align: center">{{$row->level->name}}</td>
                            <td style="text-align: center">{{$row->time}}
                                دقیقه
                            </td>
                        <td style="text-align: center">{{$row->created_at->toDateString()}}</td>
                        <td style="text-align: center">
                            <a href="/exams/take/{{$row->id}}">
                                <button class="btn btn-primary">ورود به آزمون</button>
                            </a>
                        </td>
                    </tr>
@endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>

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
                        url: "{{  url('/exams/delete/')  }}" + '/' + id,
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


