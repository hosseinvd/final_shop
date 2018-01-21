@extends('rapiden_layouts.master')
@section('title','Larvel Shopping Cart')

@section('header')
    @include('rapiden_layouts.partials.user_header')
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}"  crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="all" href="{{asset('datePicker/js-persian-cal.css')}}" >
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
                <div class="centered-title text-center mb-40">
                    <h2>تکمیل ثبت نام</h2>
                </div>
                <div class="clear"></div>
                <form class="form-horizontal" method="post" action="{{route('user_info_submit')}}"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                    <div class="billing-fields row">
                        <p class="form-row col-sm-6">
                            <label for="billing_first_name">نام<abbr title="required" class="required">*</abbr></label>
                            <input type="text" name="name" id="name" class="form-controller" required>
                        </p>
                        <p class="form-row col-sm-6">
                            <label for="billing_last_name">نام خانوادگی<abbr title="required" class="required">*</abbr></label>
                            <input type="text" name="family" id="family" class="form-controller" required>
                        </p>
                        <p class="form-row col-sm-6">
                            <label for="billing_company">کد ملی <abbr title="required" class="required">*</abbr></label>
                            <input type="number" name="national_code" id="national_code" class="form-controller" required>
                        </p>
                        <p class="form-row col-sm-6">
                        <label>تصویر</label>
                        <input type="file" class="form-controller" name="images" id="images"
                               placeholder="تصویر " value="">
                        </p>
                        <p class="form-row col-sm-6">
                            <label for="billing_email">آدرس ایمیل<abbr title="required" class="required">*</abbr></label>
                            <input type="text" name="user_email" id="user_email" class="form-controller" required>
                        </p>
                        <p class="form-row col-sm-6">
                            <label for="billing_email">تلفن<abbr title="required" class="required">*</abbr></label>
                            <input type="text" name="phone_number" id="phone_number" class="form-controller" required>
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
                            <textarea name="address" id="address" placeholder="آدرس" class="form-controller" required></textarea>
                        </p>
                        <p class="form-row col-sm-6">
                            <label for="billing_city">شهر<abbr title="required" class="required">*</abbr></label>
                            <input type="text" name="city" id="city" class="form-controller" required>
                        </p>
                        <p class="form-row col-sm-6">
                            <label for="billing_city">تاریخ تولد<abbr title="required" class="required">*</abbr></label>
                            <input type="date" name="birthday" id="inputpicker" class="form-controller" required>
                            {{--<input type="text" id="pcal1" name="birthday" class="pdate">--}}
                        </p>
                        <p class="form-row col-sm-6">
                            <label for="billing_state">استان<abbr title="required" class="required">*</abbr></label>
                            <input type="text" name="province" id="province" class="form-controller" required>
                        </p>
                        <p class="form-row col-sm-6">
                            <label for="billing_postcode">کدپستی<abbr title="required" class="required">*</abbr></label>
                            <input type="text" name="postal_code" id="postal_code" class="form-controller" required>
                        </p>

                        <p class="col-sm-12">
                            <input type="checkbox" value="forever" id="terms" name="terms">
                            <label class="inline" for="terms">بنده <a href="#">قوانین و مقررات</a> را خوانده ام و میپذیرم.</label>
                        </p>
                        <p class="col-sm-12">
                            <input type="submit" value="ثبت نام" name="signup" class="theme-button marL0">
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
    <script type="text/javascript" src="{{asset('datePicker/js-persian-cal.min.js')}}" ></script>
    <script src="{{asset('js/dropzone.js')}}"></script>
@endsection