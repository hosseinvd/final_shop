@extends('rapiden_layouts.master')
@section('title','Larvel Shopping Cart')
@section('styles')
    {{--    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}"  crossorigin="anonymous">--}}
    <link rel="stylesheet" href="{{asset('css/persian-datepicker.css')}}" crossorigin="anonymous">

@endsection
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
            <p><strong>مبلغ قابل پرداخت </strong>{{$pay-$payments->sum('price')}}</p>
            @if ($pay<=$payments->sum('price'))
                <a href="{{route('user-orders')}}"> مرحله بعدی</a>
            @endif
            <div class="row">
                @if($payments->count()>0)
                    @foreach($payments as $index=>$payment)
                        @if($payment->pay_method==2)
                        <div class="col-md-3">
                            <div class="panel panel-warning">
                                <div class="panel-heading center-block">
                                    <p><strong>بانک : </strong>{{$payment->cheque->bank}}<strong> / شماره چک
                                            : </strong> {{$payment->cheque->serial_number}} </p>
                                </div>
                                <div class="panel-body">
                                    <p><strong>تاریخ :</strong> {{jdate($payment->cheque->due_date)->format('%d %B، %Y')}} </p>
                                    <p><strong>مبلغ :</strong> {{$payment->cheque->price}} ریال </p>
                                    <div class="panel-footer">
                                        <strong>زمان باقی مانده :</strong>
                                        <?php
                                        $due = \Carbon\Carbon::parse($payment->cheque->due_date);
                                        $now = \Carbon\Carbon::now();
                                        echo $due->diffInDays($now) . ' روز ';
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif($payment->pay_method==1)
                        <div class="col-md-3">
                            <div class="panel panel-warning">
                                <div class="panel-heading center-block">
                                    <p><strong>پرداخت نقدی </strong> </p>
                                </div>
                                <div class="panel-body">
                                    <p><strong>تاریخ :</strong> {{jdate($payment->transaction_date)->format('%d %B، %Y')}} </p>
                                    <p><strong>مبلغ :</strong> {{$payment->price}} ریال </p>
                                    <div class="panel-footer">
                                        <p><strong>پرداخت شده در </strong> {{jdate($payment->transaction_date)->ago()}} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endif
                <div class=" container col-lg-12 col-md-12">
                    <div class="panel-group" id="accordion">
                        <form class="form-horizontal" method="post" action="{{route('user_add_pay')}}"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                            پرداخت نقدی
                                        </a>
                                    </h4>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div id="collapse1" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="checkout-form-list">
                                                    <label>مبلغ (ریال) <span class="required">*</span></label>
                                                    <input type="text" name="price"
                                                           value="{{old('price')}}" placeholder="">
                                                    <input type="hidden" name="basket_id" value="{{$basket_id}}">
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-sm-12">
                                                <div class="order-button-payment">
                                                    <input type="submit" value="پرداخت">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form class="form-horizontal" method="post" action="{{route('user_add_cheque')}}"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                           اضافه کردن چک
                                        </a>
                                    </h4>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div id="collapse2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="checkout-form-list">
                                                    <label>شماره سریال چک <span class="required">*</span></label>
                                                    <input type="text" name="serial_number"
                                                           value="{{old('serial_number')}}" placeholder="">
                                                    <input type="hidden" name="basket_id" value="{{$basket_id}}">

                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="checkout-form-list">
                                                    <label>مبلغ <span class="required"></span></label>
                                                    <input type="text" name="price" value="{{old('price')}}"
                                                           placeholder="price">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="checkout-form-list">
                                                    <label>موعد پرداخت <span class="required"></span></label>
                                                    <input type="date" name="due_date" id="start_date"
                                                           value="{{old('due_date')}}" class="form-controller" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="checkout-form-list">
                                                    <label> بانک <span class="required"></span></label>
                                                    <input type="text" name="bank" value="{{old('bank')}}"
                                                           placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="checkout-form-list">
                                                    <label>شعبه <span class="required"></span></label>
                                                    <input type="text" name="bank_address"
                                                           value="{{old('bank_address')}}" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="checkout-form-list">
                                                    <label>چک در وجه <span class="required">*</span></label>
                                                    <input type="text" name="pay_to" value="{{old('pay_to')}}"
                                                           placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="checkout-form-list">
                                                    <label>شماره تلفن صاحب چک <span class="required">*</span></label>
                                                    <input type="text" name="mobile_number"
                                                           value="{{old('mobile_number')}}" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-sm-12">
                                                <div class="checkout-form-list">
                                                    <label>توضیحات <span class="required"></span></label>
                                                    <input type="text" name="description" value="{{old('description')}}"
                                                           placeholder="چنانچه چک متعلق به شخص دیگری است اعلام کنید">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="order-button-payment">
                                                    <input type="submit" value="ثبت چک">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- checkout-area end -->
        <!-- brand-area-start -->
        @endsection
        @section('scripts')
            <script src="{{asset('js/persian.date.js')}}"></script>
            <script src="{{asset('js/persian.datepicker.0.4.5.js')}}"></script>
            <script>
                $("#start_date").pDatepicker({
                    format: "YYYY-MM-DD",
                    autoClose: true,
                    toolbox: false
                });


            </script>
    </div>
@endsection