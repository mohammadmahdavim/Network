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
            <h3> لیست اولیه</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">لیست اسامی</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> لیست اولیه</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            @if($count>=200)
                <a href="/members/questions/emotional/bronze">
                    <button class="btn btn-primary">اعتبار عاطفی</button>
                </a>
            @endif
            @if(\App\Models\Member::where('author', auth()->user()->id)
            ->where('status', 'bronze')->whereNotNull('emotional')->count()>=200)

                <a href="/members/questions/work/bronze">
                    <button class="btn btn-primary">اعتبار کاری</button>
                </a>
                @endif
                @if(\App\Models\Member::where('author', auth()->user()->id)
             ->where('status', 'bronze')->whereNotNull('work')->count()>=200)

                    <a href="/members/analyze">
                        <button class="btn btn-warning">آنالیز</button>
                    </a>

                @endif
                <!-- Button trigger modal -->
                <form action="/members/create" method="post">
                    @csrf
                    <br>
                    @include('include.success')
                    <div class="row">
                        <div class="col-md-4">
                            <label>نام</label>
                            <input class="form-control" name="name" required id="myTextInput">
                        </div>
                        <div class="col-md-4">
                            <label>شهرت</label>
                            <input class="form-control" name="family" required>
                        </div>
                        <div class="col-md-4">
                            <br>

                            <button type="submit" class="btn btn-primary ">
                                <i class="fa fa-plus"></i>
                            </button>

                        </div>
                    </div>
                </form>

                <div class="">
                    <br>
                    <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                        <thead>
                        <tr class="success" style="text-align: center">
                            <th>شمارنده</th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
{{--                            <th>اعتبار احساسی</th>--}}
{{--                            <th>اعتبار کاری</th>--}}
{{--                            <th>مجموع</th>--}}
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                                <?php $idn = 1 +(($rows->currentPage()-1)*$rows->perpage()); ?>
                            @foreach($rows as $row)
                                <td style="text-align: center">{{$idn}}</td>
                                <td style="text-align: center">{{$row->name}}</td>
                                <td style="text-align: center">{{$row->family}}</td>
{{--                                <td style="text-align: center">{{$row->emotional }}</td>--}}
{{--                                <td style="text-align: center">{{$row->work }}</td>--}}
{{--                                <td style="text-align: center">{{$row->work + $row->emotional }}</td>--}}

                                <td style="text-align: center">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModal{{$row->id}}">
                                        ویرایش
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$row->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="/members/update/{{$row->id}}" method="post">
                                                {{csrf_field()}}
                                                {{method_field('PATCH')}}
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>نام</label>
                                                                <input class="form-control" name="name" required
                                                                       value="{{$row->name}}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>شهرت</label>
                                                                <input class="form-control" name="family" required
                                                                       value="{{$row->family}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">بستن
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">ذخیره</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <button class="btn  btn-danger" onclick="deleteData({{$row->id}})"><i
                                            class="fa fa-trash"></i></button>
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


