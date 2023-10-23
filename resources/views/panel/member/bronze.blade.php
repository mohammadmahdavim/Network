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
            @if($count>=100)
                <a href="/members/analyze">
                    <button class="btn btn-warning">آنالیز</button>
                </a>
            @endif
        <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalmemeber">
                تعریف فرد جدید
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalmemeber" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">تعریف فرد جدید</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/members/create" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>نام</label>
                                        <input class="form-control" name="name">
                                    </div>
                                    <div class="col-md-4">
                                        <label>موبایل</label>
                                        <input class="form-control" name="mobile">
                                    </div>
{{--                                    <div class="col-md-4">--}}
{{--                                        <label>کد ملی</label>--}}
{{--                                        <input class="form-control" name="national_code">--}}
{{--                                    </div>--}}
                                </div>
                                <hr>
                                <h4>سوالات</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <b>1.</b>
                                        <span>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</span>
                                        <div class="form-check">
                                            <input value="10" class="form-check-input" type="radio" name="question_one"
                                                   id="question_one1">
                                            <label class="form-check-label" for="question_one1">
                                                Default radio
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input value="8" class="form-check-input" type="radio" name="question_one"
                                                   id="question_one2" checked>
                                            <label class="form-check-label" for="question_one2">
                                                Default checked radio
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input value="5" class="form-check-input" type="radio" name="question_one"
                                                   id="question_one3" checked>
                                            <label class="form-check-label" for="question_one3">
                                                Default checked radio
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input value="2" class="form-check-input" type="radio" name="question_one"
                                                   id="question_one4" checked>
                                            <label class="form-check-label" for="question_one4">
                                                Default checked radio
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <b>2.</b>
                                        <span>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</span>
                                        <div class="form-check">
                                            <input value="8" class="form-check-input" type="radio" name="question_tow"
                                                   id="question_tow1">
                                            <label class="form-check-label" for="question_tow1">
                                                Default radio
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input value="5" class="form-check-input" type="radio" name="question_tow"
                                                   id="question_tow2" checked>
                                            <label class="form-check-label" for="question_tow2">
                                                Default checked radio
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input value="3" class="form-check-input" type="radio" name="question_tow"
                                                   id="question_tow3" checked>
                                            <label class="form-check-label" for="question_tow3">
                                                Default checked radio
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input value="1" class="form-check-input" type="radio" name="question_tow"
                                                   id="question_tow4" checked>
                                            <label class="form-check-label" for="question_tow4">
                                                Default checked radio
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-block">ثبت اطلاعات</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="">
                <br>
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>شمارنده</th>
                        <th>نام</th>
                        <th>موبایل</th>
{{--                        <th>کدملی</th>--}}
                        <th>امتیاز</th>
                        <th>تاریخ ایجاد</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php $idn = 1; ?>
                        @foreach($rows as $row)
                            <td style="text-align: center">{{$idn}}</td>
                            <td style="text-align: center">{{$row->name}}</td>
                            <td style="text-align: center">{{$row->mobile}}</td>
{{--                            <td style="text-align: center">{{$row->national_code}}</td>--}}
                            <td style="text-align: center">{{$row->point_1}}</td>
                            <td style="text-align: center">{{$row->created_at->toDateString()}}</td>
                            <td style="text-align: center">
                                {{--                                <a href="/memebers/{{$row->id}}/edit">--}}
                                {{--                                    <button class="btn btn-success">ویرایش</button>--}}
                                {{--                                </a>--}}
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


