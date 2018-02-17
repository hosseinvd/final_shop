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
                    <li class="active">ایجاد کد تخفیف</li>
                </ol>
            </div>
        </div>
        <div class="container ">
            <div class="panel-heading"><h2>ایجاد تخفیف </h2></div>
            <form class="form-horizontal" method="post" action="{{route('discount.store')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="code">کد :</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="code" placeholder="code" name="code" required>
                        </div>
                        <label class="control-label col-sm-2" for="type" required>نوع تخفیف :</label>
                        <div class="col-sm-4">
                            <select class="form-control m-bot15"
                                              id="type" name="type">
                                <option value='Discount'>تخفیف </option>
                                <option value='reseller_Discount'>تخفیف و حق بازاریاب</option>
                                <option value='reseller'>حق بازاریاب</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="percent" >درصد تخفیف :</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="percent" placeholder="percent" name="percent" required>
                        </div>
                        <label class="control-label col-sm-2" for="value">مقدار تخفیف :</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="value" placeholder="value" name="value">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="commission" required>حق بازاریاب :</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="commission" placeholder="commission" name="commission">
                        </div>
                        <label class="control-label col-sm-2" for="calc_mode">نوع محاسبه :</label>
                        <div class="col-sm-4">
                            <select class="form-control m-bot15"
                                    id="calc_mode" name="calc_mode">
                                <option value='PERCENT'>درصد</option>
                                <option value='VALUE'>مقدار</option>
                                <option value='MAX'>حداکثر </option>
                                <option value='MIN'>حداقل</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="start_date">شروع تخفیف :</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="start_date" placeholder="start_date" name="start_date">
                        </div>
                        <label class="control-label col-sm-2" for="end_date">پایان تخفیف :</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="end_date" placeholder="end_date" name="end_date">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="description">توضیح مختصر :</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="description" placeholder="description" name="description">
                        </div>
                        <label class="control-label col-sm-2" for="end_date">تعداد :</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="numbers" placeholder="numbers" name="numbers" value="1">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12" style="padding: 0;">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1"> جستجو </label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="user_name"
                                   name="user_name"
                                   class="form-control" value=''
                                   placeholder="شماره ملی یا نام خانوادگی را وارد کنید.">
                            <br>
                        </div>
                    </div>
                    <div class="col-md-12" id="user_table">
                        <input hidden type="hidden" class="form-control" id="user_id" placeholder="user_id" name="user_id" value="{{Auth::user()->id}}">
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block" id="add_discount">Submit</button>
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
