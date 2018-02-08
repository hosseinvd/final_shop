@extends('admin.layouts.admin_master')
@section('title','Larvel Shopping Cart')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/persian-datepicker.css')}}" crossorigin="anonymous">
@endsection
@section('content')
    @include('Admin.partials.errors')
<br>
        <div class="breadcrumb-area">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="{{route('a_Dashboard')}}"><i class="fa fa-home"></i> داشبورد</a></li>
                    <li class="active">مشاهده اطلاعات کد تخفیف</li>
                </ol>
            </div>
        </div>
        <div class="container ">
            <div class="panel-heading"><h2>مشاهده اطلاعات کد تخفیف</h2></div>
            <form class="form-horizontal" method="post" action="{{route('discount.store')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="code">کد :</label>
                        <div class="col-sm-4">
                            {{$discount->code}}
                        </div>
                        <label class="control-label col-sm-2" for="type" required>نوع تخفیف :</label>
                        <div class="col-sm-4">

                            {{$discount->type}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="percent" >درصد تخفیف :</label>
                        <div class="col-sm-4">
                            {{$discount->percent}}
                        </div>
                        <label class="control-label col-sm-2" for="value">مقدار تخفیف :</label>
                        <div class="col-sm-4">
                            {{$discount->value}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="commission" required>حق بازاریاب :</label>
                        <div class="col-sm-4">
                            {{$discount->commission}}
                        </div>
                        <label class="control-label col-sm-2" for="calc_mode">نوع محاسبه :</label>
                        <div class="col-sm-4">
                           {{$discount->calc_mode}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="start_date">شروع تخفیف :</label>
                        <div class="col-sm-4">
                            {{jdate($discount->start_date)->format('date')}}
                        </div>
                        <label class="control-label col-sm-2" for="end_date">پایان تخفیف :</label>
                        <div class="col-sm-4">
                            {{jdate($discount->end_date)->format('date')}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="description">توضیح مختصر :</label>
                        <div class="col-sm-4">
                            {{$discount->description}}
                        </div>
                        <label class="control-label col-sm-2" for="end_date">تعداد :</label>
                        <div class="col-sm-4">
                            {{$discount->numbers}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12" style="padding: 0;">
                    <h3>{{$discount->user->name}}</h3>
                </div>

            </form>
        </div>
@endsection
@section('scripts')
    <script src="{{asset('js/persian.date.js')}}"></script>
    <script src="{{asset('js/persian.datepicker.0.4.5.js')}}"></script>

    <script>


        $("#user_name").keyup(function () {
            var user_name = $("#user_name").val();
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            if(user_name.length>-1){
                $.post("/admin/Update",
                    {
                        user_name: user_name,
                        _token: CSRF_TOKEN,
                        request_name: "user_sel"
                    },
                    function (data) {
                        $("#user_table").html(data);
                    });
            }
        });

        $("#start_date").pDatepicker({
            format : "YYYY-MM-DD",
            autoClose : true,
            toolbox : false
        });

        $("#end_date").pDatepicker({
            format : "YYYY-MM-DD",
            autoClose : true,
            toolbox : false
        });

        $("#start_date").pDatepicker("setDate", [1396,01,01]);
        $("#end_date").pDatepicker("setDate", [1399,01,01]);

    </script>
@endsection
