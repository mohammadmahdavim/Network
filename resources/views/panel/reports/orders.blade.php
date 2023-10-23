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
            <h3>سفارشات</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">گزارشات</a></li>
                    <li class="breadcrumb-item active" aria-current="page">سفارشات</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="">
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>#</th>
                        <th>محصول</th>
                        <th>قیمت</th>
                        <th>نام</th>
                        <th>شماره موبایل</th>
                        <th>تاریخ پرداخت</th>
                        <th>تاریخ ثبت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php $idn = 1; ?>
                        @foreach($rows as $row)
                            <td style="text-align: center">
                                <img src="/product/{{$row->product->image}}" width="50" height="50" class="rounded">
                            </td>
                            <td style="text-align: center">{{$row->product->title}}</td>
                            <td style="text-align: center">{{$row->product->price}}</td>

                            <td style="text-align: center">{{$row->user->name}}</td>
                            <td style="text-align: center">{{$row->user->mobile}}</td>
                            <td style="text-align: center">{{$row->payed_at}}</td>
                            <td style="text-align: center">{{$row->created_at->toDateString()}}</td>
                            <td style="text-align: center">
                                <select class="form-control" id="status" name="status"
                                        onchange="status(this,{{$row->id}})">
                                    <option @if($row->status=='waiting') selected @endif value="waiting">سفارش بدون
                                        پرداخت
                                    </option>
                                    <option @if($row->status=='paid') selected @endif value="paid">سفارش پرداخت شده
                                    </option>
                                    <option @if($row->status=='send') selected @endif value="send">ارسال شده</option>
                                </select>

                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#exampleModal{{$row->id}}">
                                    اطلاعات
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$row->id}}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">اطلاعات</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-right">
                                                <ul>
                                                    <li>
                                                        <b>موبایل:</b>
                                                        {{$row->user->mobile}}
                                                    </li>
                                                    <li>
                                                        <b>ایمیل:</b>
                                                        {{$row->user->email}}
                                                    </li>
                                                    <li>
                                                        <b>کد پستی:</b>
                                                        {{$row->user->postal_code}}
                                                    </li>
                                                    <li>
                                                        <b>شهر:</b>
                                                        {{$row->user->city}}
                                                    </li>
                                                    <li>
                                                        <b>آدرس:</b>
                                                        {{$row->user->address}}
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>

{{--                                <button class="btn  btn-danger btn-sm" onclick="deleteData({{$row->id}})"><i--}}
{{--                                        class="fa fa-trash"></i></button>--}}
                            </td>
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
                        url: "{{  url('/blogs/delete/')  }}" + '/' + id,
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

    function status(status, id) {
        var sleTex = status.options[status.selectedIndex].innerHTML;
        var selVal = status.value;
        swal({
            title: "آیا از تغییر مطمئن هستید؟",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{  url('/invoice/status/')  }}" + '/' + id + '/' + selVal,
                        type: "GET",

                        success: function () {
                            swal({
                                title: "تغییر با موفقیت انجام شد!",
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
                    swal("عملیات تغییر لغو گردید");
                }
            });
    }

</script>


