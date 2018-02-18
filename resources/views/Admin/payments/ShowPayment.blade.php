@extends('admin.layouts.admin_master')
@section('title','Larvel Add Product')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/persian-datepicker.css')}}" crossorigin="anonymous">

@endsection
@section('content')
    @include('Admin.partials.errors')
    <div class="container">
        <div class="breadcrumb-area">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="{{route('a_Dashboard')}}"><i class="fa fa-home"></i> داشبورد</a></li>
                    <li class="active"> چک</li>
                </ol>
            </div>
        </div>

        <!-- breadcrumb end -->
        <!-- checkout-area start -->

            <div class="container">
                <form class="form-horizontal" method="post" action="{{route('a_update_payment')}}"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="panel panel-danger">

                    <div class="panel-heading"><h2>مشخصات چک  </h2></div>
                        <br>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label col-sm-2">تاریخ <span class="required"></span></label>
                            <div class="col-sm-4">
                                {{jdate($payment->cheque->due_date)->format('%d %B، %Y')}}
                            </div>
                            <label class="control-label col-sm-2">شماره سریال چک <span class="required">*</span></label>
                            <div class="col-sm-4">
                                {{$payment->cheque->serial_number}}
                                <input type="hidden" name="basket_id" value="{{$payment->basket_id}}">
                                <input type="hidden" name="payment_id" value="{{$payment->id}}">
                                <input type="hidden" name="cheque_id" value="{{$payment->cheque->id}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2">به موجب این چک مبلغ  <span class="required"></span></label>
                            <div class="col-sm-4">
                                {{$payment->price}} ریال
                            </div>
                            <label class="control-label col-sm-2"> در وجه <span class="required">*</span></label>
                            <div class="col-sm-4">
                                {{$payment->cheque->pay_to}}
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="control-label col-sm-2"> بانک <span class="required"></span></label>
                            <div class="col-sm-4">
                                {{$payment->cheque->bank}}
                            </div>
                            <label class="control-label col-sm-2">شعبه <span class="required"></span></label>
                            <div class="col-sm-4">
                                {{$payment->cheque->bank_address}}
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">شماره تلفن صاحب چک <span
                                        class="required">*</span></label>
                            <div class="col-sm-4">
                                {{$payment->cheque->mobile_number}}
                            </div>
                            <label class="control-label col-sm-2">توضیحات <span class="required"></span></label>
                            <div class="col-sm-4">
                                {{$payment->cheque->description}}
                            </div>

                        </div>

                    </div>
                        <div class="panel-footer">

                        </div>
                    </div>
                </form>
            </div>
    </div>

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

@endsection


