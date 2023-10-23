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
@section('content')

    @if(auth()->user()->role=='admin')
        <div class="row">
            <div class="col-md-3">

                <div class="card text-center">
                    <div class="card-body">
                        <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating">
                            <i class="fa fa-user-o"></i>
                        </div>
                        <h3 class="font-weight-800 primary-font">{{\App\Models\User::all()->count()}}</h3>
                        <p>مجموع کاربران</p>
                    </div>
                </div>

            </div>
            <div class="col-md-3">

                <div class="card text-center">
                    <div class="card-body">
                        <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating">
                            <i class="fa fa-user-o"></i>
                        </div>
                        <h3 class="font-weight-800 primary-font">{{\App\Models\User::all()->where('level_id',1)->count()}}</h3>
                        <p>تعداد مهمان</p>
                    </div>
                </div>

            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-3">

                <div class="card text-center">
                    <div class="card-body">
                        <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating">
                            <i class="fa fa-user-o"></i>
                        </div>
                        <?php
                        $createDate = auth()->user()->created_at;
                        $now = \Carbon\Carbon::now();

                        $diff = $createDate->diffInDays($now);
                        ?>
                        <h3 class="font-weight-800 primary-font">{{$diff}}
                            روز
                        </h3>
                        <p>گذشته از شروع فعالیت</p>
                    </div>
                </div>

            </div>
        </div>

    @endif
    @if(auth()->user()->level_id==1)
        <div class="card">
            <div class="card-header">
                کد معرف خود را وارد کنید.
            </div>
            <div class="card-body">
                <form method="post" action="/insert_code">
                    @csrf
                    @include('include.errors')
                    <div class="row">
                        <div class="col-md-3">
                            <input name="code" value="{{old('code')}}" class="form-control"
                                   placeholder="کد معرف خود را وارد کنید." required>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-info">ثبت</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-header">
                کد های دعوت شما
            </div>
            <div class="card-body">
                <ol>
                    @foreach(auth()->user()->codes as $code)
                        <li @if($code->used==1) style="color: red" @else style="color: black" @endif>
                            {{$code->identification->code}}
                            @if($code->used==1)
                                <span style="color: red">استفاده شده</span>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    @endif
@endsection('content')


