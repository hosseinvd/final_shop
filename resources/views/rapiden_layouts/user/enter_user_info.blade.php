@extends('rapiden_layouts.master')
@section('title','Larvel Shopping Cart')

@section('header')
    @include('rapiden_layouts.partials.user_header')
@endsection
@section('styles')
{{--    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}"  crossorigin="anonymous">--}}
<link rel="stylesheet" href="{{asset('css/persian-datepicker.css')}}" crossorigin="anonymous">

@endsection
@section('mainmenu')
    @include('rapiden_layouts.partials.user_mainmenu')
@endsection

@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-area">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{route('products')}}"><i class="fa fa-home"></i> خانه</a></li>
                <li class="active">حساب کاربری</li>
            </ol>
        </div>
    </div>
    <!-- breadcrumb end -->
    <!-- login-area start -->
    <div class="login-area pt-30">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 text-center">
                            {{--<i class="fa fa-user fa-5x" aria-hidden="true"></i>--}}
                            <img src="{{asset('images/profile_img').'/'.$user_info->imagePath}}" alt=""
                                 class="center-block img-circle img-responsive">
                            <ul class="list-inline ratings text-center" title="Ratings">
                                <li><a href="#"><span class="fa fa-star fa-lg"></span></a></li>
                                <li><a href="#"><span class="fa fa-star fa-lg"></span></a></li>
                                <li><a href="#"><span class="fa fa-star fa-lg"></span></a></li>
                                <li><a href="#"><span class="fa fa-star fa-lg"></span></a></li>

                            </ul>
                        </div><!--/col-->
                        <div class="col-xs-12 col-sm-8">
                            <h2>{{$user_info->name.' '.$user_info->family }}</h2>
                            <p><strong>کد ملی :</strong> {{$user_info->national_code}} </p>
                            <p><strong>آدرس :</strong> {{$user_info->address}} </p>
                            <p><strong>کدپستی :</strong> {{$user_info->postal_code}} </p>
                            <p><strong>پست الکترونیکی :</strong> {{$user_info->user_email}} </p>
                            <p><strong>نوع کاربر </strong>
                                <span class="label label-success">General User</span>
                            </p>
                        </div><!--/col-->
                    </div><!--/row-->
                </div><!--/panel-body-->
            </div><!--/panel-->
                </div>
            </div>
            <div class="row">
                <div class="centered-title text-center mb-40">
                    <h2>ویرایش اطلاعات</h2>
                </div>
                <div class="clear"></div>
                <form class="form-horizontal" method="post" action="{{route('user_info_submit')}}"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                    <div class="billing-fields row">
                        <p class="form-row col-sm-6">
                            <label for="billing_first_name">نام<abbr title="required" class="required">*</abbr></label>
                            <input type="text" name="name" id="name" class="form-controller" required value="{{$user_info->name}}">
                        </p>
                        <p class="form-row col-sm-6">
                            <label for="billing_last_name">نام خانوادگی<abbr title="required" class="required">*</abbr></label>
                            <input type="text" name="family" id="family" class="form-controller" value="{{$user_info->family}}" required>
                        </p>
                        <p class="form-row col-sm-6">
                            <label for="billing_company">کد ملی <abbr title="required" class="required">*</abbr></label>
                            <input type="number" name="national_code" id="national_code"  value="{{$user_info->national_code}}" class="form-controller" required>
                        </p>
                        <p class="form-row col-sm-6">
                        <label>تصویر</label>
                        <input type="file" class="form-controller" name="images" id="images"
                               placeholder="تصویر " value="" >
                        </p>
                        <p class="form-row col-sm-6">
                            <label for="billing_email">آدرس ایمیل<abbr title="required" class="required">*</abbr></label>
                            <input type="text" name="user_email" id="user_email" value="{{$user_info->user_email}}" class="form-controller" required>
                        </p>
                        <p class="form-row col-sm-6">
                            <label for="billing_email">تلفن<abbr title="required" class="required">*</abbr></label>
                            <input type="text" name="phone_number" id="phone_number" value="{{$user_info->phone_number}}" class="form-controller" required>
                        </p>
                        <p class="form-row col-sm-12">
                            <label for="billing_country">کشور<abbr title="required" class="required">*</abbr></label>
                            <select class="billing_country" id="billing_country" name="country">
                                <option value="">انتخاب کشور</option>
                                <option value="iran">ایران</option>
                            </select>
                        </p>
                        <p class="form-row col-sm-12">
                            <label for="billing_address_1">آدرس<abbr title="required" class="required">*</abbr></label>
                            <textarea name="address" id="address" placeholder="آدرس" value="{{$user_info->address}}" class="form-controller" required>{{$user_info->address}}</textarea>
                        </p>
                        <p class="form-row col-sm-6">
                            <label for="billing_city">شهر<abbr title="required" class="required">*</abbr></label>
                            <input type="text" name="city" id="city" value="{{$user_info->city}}" class="form-controller" required>
                        </p>
                        <p class="form-row col-sm-6">
                            <label for="billing_city">تاریخ تولد<abbr title="required" class="required">*</abbr></label>
                            <input type="date" name="birthday" id="start_date" value="{{jdate($user_info->birthday)->format('%d %B، %Y')}}" class="form-controller" required>
                            {{--<input type="text" id="pcal1" name="birthday" class="pdate">--}}
                        </p>
                        <p class="form-row col-sm-6">
                            <label for="billing_state">استان<abbr title="required" class="required">*</abbr></label>
                            <input type="text" name="province" id="province" value="{{$user_info->province}}" class="form-controller" required>
                        </p>
                        <p class="form-row col-sm-6">
                            <label for="billing_postcode">کدپستی<abbr title="required" class="required">*</abbr></label>
                            <input type="text" name="postal_code" id="postal_code" value="{{$user_info->postal_code}}" class="form-controller" required>
                        </p>

                        <p class="col-sm-12">
                            <input type="checkbox" value="forever" id="terms" name="terms">
                            <label class="inline" for="terms">بنده <a href="#">قوانین و مقررات</a> را خوانده ام و میپذیرم.</label>
                        </p>
                        <p class="col-sm-12">
                            <input type="submit" value="ثبت" name="signup" class="theme-button marL0">
                        </p>
                    </div>
                </div>
                </form>
                <!-- /.col-md-6 -->
                <div class="col-md-6 marTB30">
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- login-area end -->
@endsection
@section('scripts')
    <script src="{{asset('js/persian.date.js')}}"></script>
    <script src="{{asset('js/persian.datepicker.0.4.5.js')}}"></script>
<script>
    $("#start_date").pDatepicker({
        format : "YYYY-MM-DD",
        autoClose : true,
        toolbox : false
    });


    $("#start_date").pDatepicker("setDate", [1396,01,01]);

</script>
@endsection