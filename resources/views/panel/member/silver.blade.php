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
            <h3> لیست نقره ای</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">لیست اسامی</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> لیست نقره ای</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')

@section('content')
    <div class="card">
        <div class="card-body">
                <a href="/members/questions/consult_ability/silver">
                    <button class="btn btn-primary">مشورت پذیری</button>
                </a>


            @if(\App\Models\Member::where('author', auth()->user()->id)
                 ->where('status', 'silver')->whereNull('consult_ability')->count()==0)
                <a href="/members/questions/success/silver">
                    <button class="btn btn-primary">موفقیت</button>
                </a>
            @endif
            @if(\App\Models\Member::where('author', auth()->user()->id)
                ->where('status', 'silver')->whereNull('success')->count()==0)
                <a href="/members/questions/intimacy/silver">
                    <button class="btn btn-primary">صمیمیت</button>
                </a>
            @endif
            @if(\App\Models\Member::where('author', auth()->user()->id)
              ->where('status', 'silver')->whereNull('intimacy')->count()==0)
                <a href="/members/analyze_silver">
                    <button class="btn btn-warning">آنالیز</button>
                </a>
            @endif


            <div class="table-responsive">
                <br>
                <table class="table table-bordered table-striped mb-0 table-fixed" id="myTable">
                    <thead>
                    <tr class="success" style="text-align: center">
                        <th>شمارنده</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
{{--                        <th>امتیاز برنزی</th>--}}
{{--                        <th>مشورت پذیری</th>--}}
{{--                        <th>موفقیت</th>--}}
{{--                        <th>صمیمیت</th>--}}
                        <th>امتیاز نقره ای</th>
                        {{--                        <th>عملیات</th>--}}
                        <th>اضافه به ثانویه</th>
                        <th>اضافه به سیر کل مشترک</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php $idn = 1 +(($rows->currentPage()-1)*$rows->perpage()); ?>
                        @foreach($rows as $row)
                            <td style="text-align: center">{{$idn}}</td>
                            <td style="text-align: center">{{$row->name}}</td>
                            <td style="text-align: center">{{$row->family}}</td>
{{--                            <td style="text-align: center">{{$row->work + $row->emotional }}</td>--}}
{{--                            <td style="text-align: center">{{$row->consult_ability}}</td>--}}
{{--                            <td style="text-align: center">{{$row->success}}</td>--}}
{{--                            <td style="text-align: center">{{$row->intimacy}}</td>--}}

                            <td style="text-align: center">{{$row->work + $row->emotional + $row->consult_ability + $row->success+$row->intimacy}}</td>
                            @if(\App\Models\Member::where('author', auth()->user()->id)
                                 ->where('status', 'final')->count()!=0)
                            <td><input value="second" class="form-control" type="checkbox" name="second" onclick="change('{{$row->id}}',this,'second','status2') "
                                       @if($row->status2=='second') checked @endif></td>
                            <td><input value="shared" class="form-control" type="checkbox" name="shared" onclick="change('{{$row->id}}',this,'shared','status2') "
                                       @if($row->status2=='shared') checked @endif></td>
                            @endif


                            {{--                            <td style="text-align: center">--}}
                            {{--                                <button type="button" class="btn btn-primary" data-toggle="modal"--}}
                            {{--                                        data-target="#exampleModalmemeber{{$row->id}}">--}}
                            {{--                                    ویرایش--}}
                            {{--                                </button>--}}

                            {{--                                <!-- Modal -->--}}
                            {{--                                <div class="modal fade" id="exampleModalmemeber{{$row->id}}" tabindex="-1" role="dialog"--}}
                            {{--                                     aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
                            {{--                                    <div class="modal-dialog modal-xl" role="document">--}}
                            {{--                                        <div class="modal-content">--}}
                            {{--                                            <div class="modal-header">--}}
                            {{--                                                <h5 class="modal-title" id="exampleModalLabel">ثیت سوالات جدید</h5>--}}
                            {{--                                                <button type="button" class="close" data-dismiss="modal"--}}
                            {{--                                                        aria-label="Close">--}}
                            {{--                                                    <span aria-hidden="true">&times;</span>--}}
                            {{--                                                </button>--}}
                            {{--                                            </div>--}}
                            {{--                                            <form action="/members/update_silver/{{$row->id}}" method="post">--}}
                            {{--                                                @csrf--}}
                            {{--                                                <div class="modal-body">--}}
                            {{--                                                    <div class="row">--}}
                            {{--                                                        <div class="col-md-4">--}}
                            {{--                                                            <label>نام</label>--}}
                            {{--                                                            <input class="form-control" value="{{$row->name}}" disabled>--}}
                            {{--                                                        </div>--}}
                            {{--                                                        <div class="col-md-4">--}}
                            {{--                                                            <label>موبایل</label>--}}
                            {{--                                                            <input class="form-control" value="{{$row->mobile}}"--}}
                            {{--                                                                   disabled>--}}
                            {{--                                                        </div>--}}
                            {{--                                                        <div class="col-md-4">--}}
                            {{--                                                            <label>کد ملی</label>--}}
                            {{--                                                            <input class="form-control" value="{{$row->national_code}}"--}}
                            {{--                                                                   disabled>--}}
                            {{--                                                        </div>--}}
                            {{--                                                    </div>--}}
                            {{--                                                    <hr>--}}
                            {{--                                                    <h4>سوالات</h4>--}}
                            {{--                                                    <div class="row" style="text-align: start">--}}
                            {{--                                                        <div class="col-md-4">--}}
                            {{--                                                            <b>1.</b>--}}
                            {{--                                                            <span>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</span>--}}
                            {{--                                                            <div class="form-check">--}}
                            {{--                                                                <input value="10" class="form-check-input" type="radio"--}}
                            {{--                                                                       name="question_three"--}}
                            {{--                                                                       id="question_three1">--}}
                            {{--                                                                <label class="form-check-label" for="question_three1">--}}
                            {{--                                                                    Default radio--}}
                            {{--                                                                </label>--}}
                            {{--                                                            </div>--}}
                            {{--                                                            <div class="form-check">--}}
                            {{--                                                                <input value="8" class="form-check-input" type="radio"--}}
                            {{--                                                                       name="question_three"--}}
                            {{--                                                                       id="question_three2" checked>--}}
                            {{--                                                                <label class="form-check-label" for="question_three2">--}}
                            {{--                                                                    Default checked radio--}}
                            {{--                                                                </label>--}}
                            {{--                                                            </div>--}}
                            {{--                                                            <div class="form-check">--}}
                            {{--                                                                <input value="5" class="form-check-input" type="radio"--}}
                            {{--                                                                       name="question_three"--}}
                            {{--                                                                       id="question_three3" checked>--}}
                            {{--                                                                <label class="form-check-label" for="question_three3">--}}
                            {{--                                                                    Default checked radio--}}
                            {{--                                                                </label>--}}
                            {{--                                                            </div>--}}
                            {{--                                                            <div class="form-check">--}}
                            {{--                                                                <input value="2" class="form-check-input" type="radio"--}}
                            {{--                                                                       name="question_three"--}}
                            {{--                                                                       id="question_three4" checked>--}}
                            {{--                                                                <label class="form-check-label" for="question_three4">--}}
                            {{--                                                                    Default checked radio--}}
                            {{--                                                                </label>--}}
                            {{--                                                            </div>--}}
                            {{--                                                        </div>--}}
                            {{--                                                        <div class="col-md-4">--}}
                            {{--                                                            <b>2.</b>--}}
                            {{--                                                            <span>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</span>--}}
                            {{--                                                            <div class="form-check">--}}
                            {{--                                                                <input value="8" class="form-check-input" type="radio"--}}
                            {{--                                                                       name="question_four"--}}
                            {{--                                                                       id="question_four1">--}}
                            {{--                                                                <label class="form-check-label" for="question_four1">--}}
                            {{--                                                                    Default radio--}}
                            {{--                                                                </label>--}}
                            {{--                                                            </div>--}}
                            {{--                                                            <div class="form-check">--}}
                            {{--                                                                <input value="5" class="form-check-input" type="radio"--}}
                            {{--                                                                       name="question_four"--}}
                            {{--                                                                       id="question_four2" checked>--}}
                            {{--                                                                <label class="form-check-label" for="question_four2">--}}
                            {{--                                                                    Default checked radio--}}
                            {{--                                                                </label>--}}
                            {{--                                                            </div>--}}
                            {{--                                                            <div class="form-check">--}}
                            {{--                                                                <input value="3" class="form-check-input" type="radio"--}}
                            {{--                                                                       name="question_four"--}}
                            {{--                                                                       id="question_four3" checked>--}}
                            {{--                                                                <label class="form-check-label" for="question_four3">--}}
                            {{--                                                                    Default checked radio--}}
                            {{--                                                                </label>--}}
                            {{--                                                            </div>--}}
                            {{--                                                            <div class="form-check">--}}
                            {{--                                                                <input value="1" class="form-check-input" type="radio"--}}
                            {{--                                                                       name="question_four"--}}
                            {{--                                                                       id="question_four4" checked>--}}
                            {{--                                                                <label class="form-check-label" for="question_four4">--}}
                            {{--                                                                    Default checked radio--}}
                            {{--                                                                </label>--}}
                            {{--                                                            </div>--}}
                            {{--                                                        </div>--}}
                            {{--                                                        <div class="col-md-4">--}}
                            {{--                                                            <b>2.</b>--}}
                            {{--                                                            <span>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</span>--}}
                            {{--                                                            <div class="form-check">--}}
                            {{--                                                                <input value="8" class="form-check-input" type="radio"--}}
                            {{--                                                                       name="question_five"--}}
                            {{--                                                                       id="question_five1">--}}
                            {{--                                                                <label class="form-check-label" for="question_five1">--}}
                            {{--                                                                    Default radio--}}
                            {{--                                                                </label>--}}
                            {{--                                                            </div>--}}
                            {{--                                                            <div class="form-check">--}}
                            {{--                                                                <input value="5" class="form-check-input" type="radio"--}}
                            {{--                                                                       name="question_five"--}}
                            {{--                                                                       id="question_five2" checked>--}}
                            {{--                                                                <label class="form-check-label" for="question_five2">--}}
                            {{--                                                                    Default checked radio--}}
                            {{--                                                                </label>--}}
                            {{--                                                            </div>--}}
                            {{--                                                            <div class="form-check">--}}
                            {{--                                                                <input value="3" class="form-check-input" type="radio"--}}
                            {{--                                                                       name="question_five"--}}
                            {{--                                                                       id="question_five3" checked>--}}
                            {{--                                                                <label class="form-check-label" for="question_five3">--}}
                            {{--                                                                    Default checked radio--}}
                            {{--                                                                </label>--}}
                            {{--                                                            </div>--}}
                            {{--                                                            <div class="form-check">--}}
                            {{--                                                                <input value="1" class="form-check-input" type="radio"--}}
                            {{--                                                                       name="question_five"--}}
                            {{--                                                                       id="question_five4" checked>--}}
                            {{--                                                                <label class="form-check-label" for="question_five4">--}}
                            {{--                                                                    Default checked radio--}}
                            {{--                                                                </label>--}}
                            {{--                                                            </div>--}}
                            {{--                                                        </div>--}}
                            {{--                                                    </div>--}}
                            {{--                                                </div>--}}
                            {{--                                                <div class="modal-footer">--}}
                            {{--                                                    <button type="submit" class="btn btn-primary btn-block">ثبت--}}
                            {{--                                                        اطلاعات--}}
                            {{--                                                    </button>--}}
                            {{--                                                </div>--}}
                            {{--                                            </form>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </td>--}}

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


