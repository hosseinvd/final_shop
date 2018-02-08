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
                    <li class="active">ویرایش</li>
                </ol>
            </div>
        </div>
        <div class="container ">
            <div class="panel-heading"><h2>ویرایش </h2></div>
            <form class="form-horizontal" method="post" action="{{route('discount.update',$discount->id)}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PUT">
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="code">کد :</label>
                        <div class="col-sm-4">
                            <input type="text" value="{{$discount->code}}" class="form-control" id="code" placeholder="code" name="code" required>
                        </div>
                        <label class="control-label col-sm-2" for="type" required>نوع تخفیف :</label>
                        <div class="col-sm-4">

                            <select class="form-control m-bot15"
                                              id="type" name="type">
                                @if(strcmp($discount->type,'Discount')==0)
                                    <option  value='Discount' selected>تخفیف </option>
                                @else
                                     <option value='Discount'>تخفیف </option>
                                @endif
                                @if(strcmp($discount->type,'reseller_Discount')==0)
                                     <option  value='reseller_Discount' selected>تخفیف و سهم بازاریاب </option>
                                @else
                                    <option value='reseller_Discount'>تخفیف و سهم بازاریاب </option>
                                @endif
                                @if(strcmp($discount->type,'reseller')==0)
                                     <option  value='reseller' selected>سهم بازاریاب </option>
                                @else
                                     <option value='reseller'>سهم بازاریاب </option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="percent" >درصد تخفیف :</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="percent" placeholder="percent" name="percent" value="{{$discount->percent}}" required>
                        </div>
                        <label class="control-label col-sm-2" for="value">مقدار تخفیف :</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="value" placeholder="value" name="value" value="{{$discount->value}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="commission" required>حق بازاریاب :</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="commission" placeholder="commission" name="commission" value="{{$discount->commission}}">
                        </div>
                        <label class="control-label col-sm-2" for="calc_mode">نوع محاسبه :</label>
                        <div class="col-sm-4">
                            <select class="form-control m-bot15"
                                    id="calc_mode" name="calc_mode">
                                    @if(strcmp($discount->calc_mode,'PERCENT')==0)
                                         <option  value='PERCENT' selected>درصد </option>
                                    @else
                                         <option value='PERCENT'>درصد </option>
                                    @endif
                                    @if(strcmp($discount->calc_mode,'VALUE')==0)
                                         <option  value='VALUE' selected>مقدار </option>
                                    @else
                                         <option value='VALUE'>مقدار </option>
                                    @endif
                                    @if(strcmp($discount->calc_mode,'MAX')==0)
                                         <option  value='MAX' selected>حداکثر </option>
                                    @else
                                         <option value='MAX'>حداکثر </option>
                                    @endif
                                    @if(strcmp($discount->calc_mode,'MIN')==0)
                                          <option  value='MIN' selected>حداقل </option>
                                    @else
                                          <option value='MIN'>حداقل </option>
                                    @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="start_date">شروع تخفیف :</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="start_date" value="{{$discount->start_date}}" placeholder="start_date" name="start_date">
                        </div>
                        <label class="control-label col-sm-2" for="end_date">پایان تخفیف :</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="end_date" value="{{$discount->end_date}}" placeholder="end_date" name="end_date">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="description">توضیح مختصر :</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="description" placeholder="description" value="{{$discount->description}}" name="description">
                        </div>
                        <label class="control-label col-sm-2" for="end_date">تعداد :</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="numbers" placeholder="numbers" name="numbers" value="{{$discount->numbers}}">
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
                        <h2>{{$discount->user->name}}</h2>
                        <input type="hidden"  class="form-control" name="user_name" value="{{$discount->user->name}}">
                        <input   class="form-control" id="user_id" placeholder="user_id" name="user_id" value="{{$discount->user->id}}">
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
