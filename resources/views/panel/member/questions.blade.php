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
            <h3> سوال</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">سوالات</a></li>
                    <li class="breadcrumb-item active" aria-current="page">سوال</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
            <button class="btn btn-warning">نفر
                {{$members->currentPage()}}
                ام
            </button>
            <div class="row">
                <div class="col-md-4">
                    <label>نام</label>
                    <input class="form-control" disabled value="{{$members[0]->name}}">
                </div>
                <div class="col-md-4">
                    <label>نام خانوادگی</label>
                    <input class="form-control" disabled value="{{$members[0]->family}}">
                </div>
            </div>
        </div>
    </div>

    <form action="/members/questions/store" method="post">
        @csrf
        <input name="user_id" value="{{$members[0]->id}}" hidden>
        <input name="page" value="{{$members->currentPage()}}" hidden>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    @include('include.questions.'.$type)
                    <div class="col-md-12">
                        <br>

                        <button type="submit" class="btn btn-primary btn-block">
                            ثبت
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </form>
    {{--        </div>--}}
    {{--        </div>--}}



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


