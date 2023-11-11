@extends('layouts.admin')
@section('css')
@endsection('css')
@section('script')
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <script>
        var input = document.getElementById('myTextInput');
        input.focus();
        input.select();
    </script>
@endsection('script')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3> لیست برنزی</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">لیست اسامی</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> لیست برنزی</li>
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
                        <th>اعتبار برنزی</th>

                        <th>اضافه به ثانویه</th>
                        <th>اضافه به سیر کل مشترک</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php $idn = 1 + (($rows->currentPage() - 1) * $rows->perpage()); ?>
                        @foreach($rows as $row)
                            <td style="text-align: center">{{$idn}}</td>
                            <td style="text-align: center">{{$row->name}}</td>
                            <td style="text-align: center">{{$row->family}}</td>
                            <td style="text-align: center">{{$row->work + $row->emotional }}</td>
                            @if(\App\Models\Member::where('author', auth()->user()->id)
                              ->where('status', 'final')->count()!=0)
                                <td><input value="second" class="form-control" type="checkbox" name="second"
                                           onclick="change('{{$row->id}}',this,'second','status2') "
                                           @if($row->status2=='second') checked @endif></td>
                                <td><input value="shared" class="form-control" type="checkbox" name="shared"
                                           onclick="change('{{$row->id}}',this,'shared','status2') "
                                           @if($row->status2=='shared') checked @endif></td>
                            @endif

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



