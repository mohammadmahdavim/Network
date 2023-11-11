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
            <h3> لیست مشترک</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">لیست اسامی</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> لیست مشترک</li>
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
                        <th>امتیاز</th>
                        <th>نام حامی</th>
                        <th>کدام لیست حامی</th>
                        <th>اضافه به دعوت شده ها</th>
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
                                @if($row->status=='bronze')
                                    برنزی
                                @elseif($row->status=='silver')
                                    نقره ای
                                @else
                                    طلایی
                                @endif
                            </td>
                            <td style="text-align: center">{{$row->work + $row->emotional + $row->consult_ability + $row->success+$row->intimacy +$row->age +$row->motivation +$row->free_time +$row->marital_status +$row->experience}}</td>

                            <form action="/members/questions/store" method="post">
                                @csrf
                                <input name="user_id" value="{{$row->id}}" hidden>

                                <td>
                                    <input class="form-control" name="hami" value="{{$row->hami}}" >
                                </td>
                                <td>
                                    <select class="form-control" name="hami_list">
                                        <option></option>
                                        <option @if($row->hami_list=='برنزی') selected @endif>برنزی</option>
                                        <option @if($row->hami_list=='نقره ای') selected @endif>نقره ای</option>
                                        <option @if($row->hami_list=='طلایی') selected @endif>طلایی</option>
                                        <option @if($row->hami_list=='نهایی') selected @endif>نهایی</option>
                                    </select>
                                    <button class="btn btn-sm btn-primary">ثبت</button>
                                </td>
                            </form>
                            <td><input value="second" class="form-control" type="checkbox" name="invites"
                                       onclick="change('{{$row->id}}',this,'invites','status3') "
                                       @if($row->status3=='invites') checked @endif></td>

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


