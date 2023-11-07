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
            <h3> لیست پیگیری ها</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">لیست اسامی</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> لیست پیگیری ها</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="">
                <br>
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>شمارنده</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>تاریخ پیگیری طلایی</th>
                        <th>نتیجه پیگیری طلایی</th>
                        <th>تاریخ پیگیری نقره ای</th>
                        <th>نتیجه پیگیری نقره ای</th>
                        <th>تاریخ پیگیری برنزی</th>
                        <th>نتیجه پیگیری برنزی</th>
                        <th>تاریخ پیگیری نامشخص</th>
                        <th>نتیجه پیگیری نامشخص</th>
                        <th>توضیحات</th>
                        <th>ثبت</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php $idn = 1; ?>
                        @foreach($rows as $row)
                            <td style="text-align: center">{{$idn}}</td>
                            <td style="text-align: center">{{$row->name}}</td>
                            <td style="text-align: center">{{$row->family}}</td>
                            <form action="/members/questions/store" method="post">
                                @csrf
                                <input name="user_id" value="{{$row->id}}" hidden>
                                <td>
                                    <input class="form-control"  placeholder="1402-08-16" name="golden_follow_date" value="{{$row->golden_follow_date}}">
                                </td>
                                <td>
                                    <input class="form-control"   name="golden_follow_result" value="{{$row->golden_follow_result}}">
                                </td>
                                <td>
                                    <input class="form-control"  placeholder="1402-08-16" name="silver_follow_date" value="{{$row->silver_follow_date}}">
                                </td>
                                <td>
                                    <input class="form-control"   name="silver_follow_result" value="{{$row->silver_follow_result}}">
                                </td>
                                <td>
                                    <input class="form-control"  placeholder="1402-08-16" name="bronze_follow_date" value="{{$row->bronze_follow_date}}">
                                </td>
                                <td>
                                    <input class="form-control"   name="bronze_follow_result" value="{{$row->bronze_follow_result}}">
                                </td>
                                <td>
                                    <input class="form-control"  placeholder="1402-08-16" name="final_follow_date" value="{{$row->final_follow_date}}">
                                </td>
                                <td>
                                    <input class="form-control"   name="final_follow_result" value="{{$row->final_follow_result}}">
                                </td>
                                <td>
                                    <input class="form-control"   name="presentor" value="{{$row->escription}}">
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary">ثبت</button>
                                </td>
                            </form>

                    </tr>
                        <?php $idn = $idn + 1 ?>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {!! $rows->withQueryString()->links("pagination::bootstrap-4") !!}

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
                        url: "{{  url('/members/delete/')  }}" + '/' + id,
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


