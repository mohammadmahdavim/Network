@extends('layouts.admin')
@section('css')


    <style>
        body {
            text-align: center;
        }

        h1 {
            color: #396;
            font-weight: 100;
            font-size: 40px;
            margin: 40px 0px 20px;
        }

        #clockdivme {
            font-family: sans-serif;
            color: #fff;
            display: inline-block;
            font-weight: 100;
            text-align: center;
            font-size: 30px;
        }

        #clockdivme > div {
            text-align: center;
            padding: 10px;
            border-radius: 3px;
            background: #00BF96;
            display: inline-block;
        }

        #clockdivme div > span {
            padding: 15px;
            border-radius: 3px;
            background: #00816A;
            display: inline-block;
        }

        .smalltext {
            padding-top: 5px;
            font-size: 16px;
        }
    </style>

    <!-- begin::datepicker -->
    <link rel="stylesheet" href="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css">
    <!-- end::datepicker -->

    <!-- begin::select2 -->
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
    <!-- end::select2 -->
    <style>
        hr {
            border-top: 2px dashed red;
        }
    </style>
@endsection('css')
@section('navbar')



@endsection('navbar')
@section('sidebar')

@endsection('sidebar')
@section('header')
    <div class="page-header">
        <div>
            <h3> آزمون {{$row->title}}</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="#">آزمون آنلاین</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> آزمون {{$row->title}}</li>
                </ol>
            </nav>
        </div>

    </div>
@endsection('header')
<div class="card">
    <div class="card-body">
        <div style="text-align: center;padding-right: 300px">
            <div id="clockdivme">

                <div>
                    <span class="seconds"></span>
                    <div class="smalltext">ثانیه</div>
                </div>
                <div>
                    <span class="minutes"></span>
                    <div class="smalltext">دقیقه</div>
                </div>

                <div>
                    <span class="hours"></span>
                    <div class="smalltext">ساعت</div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('content')


    <div class="card">
        <div class="card-body">
            <div style="text-align: center">
                <h4 class="panel-title" style="padding-top: 40px;font-size: large;font-family: 'B Titr' ">
                    آزمون {{$row->title}}
                    @if($row->filename)
                        <a href="{{ route('exam.download', $row->id) }}"
                           class="btn btn-outline-warning">
                            <i class="icon-download"></i>&nbsp; دانلود فایل کلی آزمون </a>
                    @endif
                </h4>
            </div>
            {{--<button class="btn btn-primary">شروع آزمون</button>--}}
            <div class="panel-heading">
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>
            <?php $id = 1 ?>
            <div id="questions">
                @foreach($questions as $question)
                    <div style="text-align: right">

                        <button class="btn btn-danger">
                            <span>سوال شماره {{$questions->currentPage()}}</span>

                        </button>

                    </div>
                    <div id="questions0">
                        <div class="row">


                            <div class="col-md-12">
                                <br>
                                <label>صورت سوال </label>
                                <br>
                                <input class="form-control" value="{{$question->title}}">
                                <br>

                            </div>
                        </div>
                        <br>
                        <label>گزینه ها</label>

                        <div class=" col-md-12">
                            @foreach($question->options as $myoptions)
                                <div class="row">
                                    &nbsp&nbsp&nbsp
                                    <span style="color:red">                                    گزینه 1:
</span>
                                    <div class="col-md-12">
                                        <input type="radio" name="answer{{$myoptions->id}}"
                                               onclick="myoption(1,{{$question->id}})" value="1"
                                               @if(!empty($question->answers[0]) && $question->answers[0]->exam_option_id==1) checked
                                               @endif class="checkbox">
                                        &nbsp
                                        <input class="form-control" type="text" readonly
                                               value="{{$myoptions['1']}}">


                                    </div>
                                    &nbsp&nbsp&nbsp
                                    <span style="color:red">                                    گزینه 2:
</span>
                                    <div class="col-md-12">

                                        <input type="radio" name="answer{{$myoptions->id}}" value="2"
                                               onclick="myoption(2,{{$question->id}})"
                                               @if(!empty($question->answers[0]) && $question->answers[0]->exam_option_id==2) checked
                                               @endif class="checkbox">
                                        &nbsp
                                        <input class="form-control" type="text" readonly
                                               value="{{$myoptions['2']}}">


                                    </div>
                                    &nbsp&nbsp&nbsp
                                    <span style="color:red">                                    گزینه 3:
</span>
                                    <div class="col-md-12">
                                        <input type="radio" name="answer{{$myoptions->id}}" value="3"
                                               onclick="myoption(3,{{$question->id}})"
                                               @if(!empty($question->answers[0]) && $question->answers[0]->exam_option_id==3) checked
                                               @endif class="checkbox">
                                        &nbsp
                                        <input class="form-control" type="text" readonly
                                               value="{{$myoptions['3']}}">

                                    </div>
                                    &nbsp&nbsp&nbsp
                                    <span style="color:red">                                    گزینه 4:
</span>

                                    <div class="col-md-12">
                                        <input type="radio" name="answer{{$myoptions->id}}" value="4"
                                               onclick="myoption(4,{{$question->id}})"
                                               @if(!empty($question->answers[0]) && $question->answers[0]->exam_option_id==4)  checked
                                               @endif class="checkbox">
                                        &nbsp
                                        <input class="form-control" type="text" readonly
                                               value="{{$myoptions['4']}}">


                                    </div>
                                </div>
                            @endforeach
                            <br>

                        </div>
                        <hr>

                    </div>
                    <?php $id = $id + 1 ?>
                @endforeach
            </div>
            {!! $questions->withQueryString()->links("pagination::bootstrap-4") !!}
                        <div>
                            <a href="/exams/finish/{{$row->id}}" title="درصورت اتمام آزمون خود این دکمه را بزنید">
                                <button class="btn btn-danger" style="text-align: center">پایان آزمون</button>
                            </a>

                        </div>
        </div>
    </div>



    <!-- begin::sweet alert demo -->
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    <!-- begin::sweet alert demo -->
@endsection('content')
@section('script')

    <!-- begin::datepicker -->
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.min.js"></script>
    <script src="/assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js"></script>
    <script src="/assets/js/examples/datepicker.js"></script>
    <!-- end::datepicker -->
    <!-- begin::select2 -->
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->

@endsection('script')
<script>


</script>
<script>
    function myoption(option, question) {

        swal({
            title: "آیا از انتخاب گزینه مطمئن هستید؟",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

            .then((willDelete) => {
                if (willDelete) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    var question_id = question;
                    var option_value = option;

                    $.ajax({
                        url: '{{ url('/exams/tik') }}',
                        type: 'POST',
                        data: {
                            _token: "{{csrf_token()}}",
                            "option_value": option_value,
                            "question_id": question_id,

                        },
                        success: function (data) {
                            swal({
                                title: data,
                                icon: "success",

                            });
                            $("#questions").load(" #questions");
                        },
                        // warning: function () {
                        //     swal({
                        //         title: "گزینecwecewه با موفقیت انتخاب شد!",
                        //         icon: "success",
                        //
                        //     });
                        //     window.location.reload(true);
                        // },
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
                    swal("عملیات  لغو گردید");
                    $("#questions").load(" #questions");

                }
            });

    }

</script>
<script>

    function getTimeRemaining(endtime) {
        const total = Date.parse(endtime) - Date.parse(new Date());
        const seconds = Math.floor((total / 1000) % 60);
        const minutes = Math.floor((total / 1000 / 60) % 60);
        const hours = Math.floor((total / (1000 * 60 * 60)) % 24);

        return {
            total,
            hours,
            minutes,
            seconds

        }

    }

    function initializeClock(id, endtime) {
        const clock = document.getElementById(id);
        const hoursSpan = clock.querySelector('.hours');
        const minutesSpan = clock.querySelector('.minutes');
        const secondsSpan = clock.querySelector('.seconds');

        function updateClock() {
            const t = getTimeRemaining(endtime);
            hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
            minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
            secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

            if (t.total <= 0) {
                clearInterval(timeinterval);
            }
        }

        updateClock();
        const timeinterval = setInterval(updateClock, 1000);
    }

    var time =  @json($endtime) ;
    if (time < 0) {
        alert('d')
    }
    // const deadline = new Date(Date.parse(new Date()) + 240 * 60 * 1000);
    const deadline = new Date(Date.parse(new Date()) + time * 1000);
    initializeClock('clockdivme', deadline);

</script>





