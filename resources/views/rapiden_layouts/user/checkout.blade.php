@extends('rapiden_layouts.master')
@section('title','Larvel Shopping Cart')

@section('header')
    @include('rapiden_layouts.partials.user_header')
@endsection

@section('mainmenu')
    @include('rapiden_layouts.partials.user_mainmenu')
@endsection

@section('content')
    <div class="container">
        <div class="breadcrumb-area">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="{{route('products')}}"><i class="fa fa-home"></i> خانه</a></li>
                    <li class="active">پرداخت</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- checkout-area start -->
    <div class="checkout-area">
        <div class="container">
            <div class="row">
                @if($user_addresses->count()>0)
                <form class="form-horizontal" method="post" action="{{route('user_payment')}}" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="col md-12">

                        <h3>
                            <label> یک آدرس انتخاب کنید یا آدرس جدید خود را وارد کنید </label>
                            <input type="hidden" name="select_address" value="not select" type="radio" required>
                        </h3>
                    @foreach($user_addresses as $index=>$address)
                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">{{$address->name_family}}</div>
                                    <div class="panel-body">
                                        <span>
                                        {{$address->address}}
                                        </span>
                                        <span>
                                        {{$address->mobile_number}}
                                        </span>
                                    </div>
                                    <div class="panel-footer">
                                        <input name="select_address" value="{{$address->id}}" type="radio" required>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="order-button-payment">
                            <input type="submit" value="مرحله بعدی">
                        </div>

                    </div>
                </form>
                @endif
                <form class="form-horizontal" method="post" action="{{route('user_add_address')}}" enctype="multipart/form-data" >
                    {{csrf_field()}}
                    <div class="col-lg-12 col-md-12">

                        <div class="different-address">
                            <div class="ship-different-title">

                                <h3>
                                    <label>وارد کردن آدرس </label>
                                    <input id="ship-box" type="checkbox">
                                </h3>
                            </div>
                            <div id="ship-box-info" class="row">

                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>نام و نام خانوادگی تحویل گیرنده <span class="required">*</span></label>
                                        <input type="text" name="name_family" value="{{old('name_family')}}" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>شماره تماس ضروری (تلفن همراه) <span class="required">*</span></label>
                                        <input type="text" name="mobile_number" value="{{old('mobile_number')}}" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>شماره تلفن ثابت تحویل گیرنده <span class="required">*</span></label>
                                        <input type="text" name="phone_number" value="{{old('phone_number')}}" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>آدرس ایمیل <span class="required"></span></label>
                                        <input type="email" name="email" value="{{old('email')}}" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="country-select">
                                        <label>استان <span class="required">*</span></label>
                                        <select name="province">
                                            <option value="isf">اصفهان</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="country-select">
                                        <label>شهر <span class="required">*</span></label>
                                        <select name="city">
                                            <option value="isf">اصفهان</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>آدرس پستی <span class="required">*</span></label>
                                        <textarea name="address" placeholder="آدرس" value="{{old('address')}}"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>کد پستی <span class="required">*</span></label>
                                        <input type="text" name="postal_code" value="{{old('postal_code')}}" placeholder="کد پستی">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="order-button-payment">
                                        <input type="submit" value="ثبت آدرس">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->
    <!-- brand-area-start -->
@endsection