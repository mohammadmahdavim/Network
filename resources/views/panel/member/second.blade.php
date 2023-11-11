@extends('layouts.admin')
@section('css')
@endsection('css')
@section('script')
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <script>

        $(document).ready(function () {

            $(".point").on("change", function () {

                var value = $(this).val();

                $.ajaxSetup({

                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                $.ajax({
                    url: '{{url('/members/change_point')}}',
                    type: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        value: value,
                    },
                    success: function () {
                        swal({
                            title: "عملیات انجام شد.",
                            icon: "success",

                        });
                        location.reload();

                    }
                })

            });

        });

    </script>

@endsection('script')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3> لیست ثانویه</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">لیست اسامی</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> لیست ثانویه</li>
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
                        <th>اعتبار</th>
                        <th>استقلال</th>
                        <th>میل به پیشرفت</th>
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
                            <td>
                                <select class="form-control point" id="">
                                    <option value="NULL_{{$row->id}}"></option>
                                    <option value="سرد_{{$row->id}}" @if($row->point=='سرد') selected @endif>سرد
                                    </option>
                                    <option value="ولرم_{{$row->id}}" @if($row->point=='ولرم') selected @endif>ولرم
                                    </option>
                                    <option value="گرم_{{$row->id}}" @if($row->point=='گرم') selected @endif> گرم
                                    </option>
                                </select>
                            </td>
                            <td><input value="second" class="form-control" type="checkbox" name="second"
                                       onclick="change('{{$row->id}}',this,'1','esteghlal') "
                                       @if($row->esteghlal==1) checked @endif></td>
                            </td>
                            <td><input value="second" class="form-control" type="checkbox" name="second"
                                       onclick="change('{{$row->id}}',this,'1','growth') "
                                       @if($row->growth==1) checked @endif></td>
                            </td>
                            <td>
                                @if($row->growth and $row->esteghlal)

                                    <input value="second" class="form-control" type="checkbox" name="invites"
                                           onclick="change('{{$row->id}}',this,'invites','status3') "
                                           @if($row->status3=='invites') checked @endif>
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



