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
            <h3> لیست دعوت شده ها</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">لیست اسامی</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> لیست دعوت شده ها</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <br>
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>شمارنده</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>کدام لیست</th>
                        <th>تاریخ دعوت</th>
                        <th>نحوه دعوت</th>
                        <th>اضافه به پرزنت شده ها</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php $idn = 1; ?>
                        @foreach($rows as $row)
                            <td style="text-align: center">{{$idn}}</td>
                            <td style="text-align: center">{{$row->name}}</td>
                            <td style="text-align: center">{{$row->family}}</td>
                            <td style="text-align: center">
                                @if($row->status2=='shared')
                                    مشترک
                                @elseif($row->status2=='second')
                                    ثانویه
                                @elseif($row->status=='final')
                                    نهایی
                                @elseif($row->status=='golden')
                                    طلایی
                                @endif
                            </td>
                            <form action="/members/questions/store" method="post">
                                @csrf
                                <input name="user_id" value="{{$row->id}}" hidden>
                            <td>
                                <input class="form-control"  placeholder="1402-08-16" name="invite_date" value="{{$row->invite_date}}">
                            </td>
                            <td>
                                <select class="form-control" name="invite_type">
                                    <option></option>
                                    <option @if($row->invite_type=='تماس تلفنی') selected @endif>تماس تلفنی</option>
                                    <option @if($row->invite_type=='حضوری') selected @endif>حضوری</option>
                                </select>
                                <button class="btn btn-sm btn-primary">ثبت</button>
                            </td>
                            </form>

                            <td>
                                @if($row->invite_date and $row->invite_type)
                                    <input value="second" class="form-control" type="checkbox" name="presents"
                                           onclick="change('{{$row->id}}',this,'presents','status3') "
                                           @if($row->status3=='presents') checked @endif>
                                @endif
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


