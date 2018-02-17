@extends('admin.layouts.admin_master')
@section('title','Larvel Add Product')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}" crossorigin="anonymous">
@endsection
@section('content')
    @include('Admin.partials.errors')
    <div class="container">
        <div class="breadcrumb-area">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="{{route('a_Dashboard')}}"><i class="fa fa-home"></i> داشبورد</a></li>
                    <li class="active">اصلاح چک</li>
                </ol>
            </div>
        </div>

        <!-- breadcrumb end -->
        <!-- checkout-area start -->

            <div class="container">
                <form class="form-horizontal" method="post" action="{{route('a_update_payment')}}"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="panel panel-info">

                    <div class="panel-heading"><h2>ویرایش چک  </h2></div>
                        <br>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label col-sm-2">شماره سریال چک <span class="required">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="serial_number"
                                       value="{{$payment->cheque->serial_number}}" placeholder="">
                                <input type="hidden" name="basket_id" value="{{$payment->basket_id}}">
                            </div>

                            <label class="control-label col-sm-2">مبلغ <span class="required"></span></label>
                            <div class="col-sm-4">
                                <input type="text" name="price" value="{{$payment->price}}"
                                       placeholder="price">
                            </div>
                        </div>
                        <div class="form-group">

                            <label class="control-label col-sm-2">موعد پرداخت <span class="required"></span></label>
                            <div class="col-sm-4">
                                <input type="date" name="due_date" id="start_date"
                                       value="{{jdate($payment->cheque->due_date)->format('%d %B، %Y')}}"
                                       class="form-controller" required>
                            </div>

                            <label class="control-label col-sm-2"> بانک <span class="required"></span></label>
                            <div class="col-sm-4">
                                <input type="text" name="bank" value="{{$payment->cheque->bank}}"
                                       placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">شعبه <span class="required"></span></label>
                            <div class="col-sm-4">
                                <input type="text" name="bank_address"
                                       value="{{$payment->cheque->bank_address}}" placeholder="">
                            </div>
                            <label class="control-label col-sm-2">چک در وجه <span class="required">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="pay_to" value="{{$payment->cheque->pay_to}}"
                                       placeholder="">
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">شماره تلفن صاحب چک <span
                                        class="required">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="mobile_number"
                                       value="{{$payment->cheque->mobile_number}}" placeholder="">
                            </div>
                            <label class="control-label col-sm-2">توضیحات <span class="required"></span></label>
                            <div class="col-sm-4">
                                <input type="text" name="description" value="{{$payment->cheque->description}}"
                                       placeholder="چنانچه چک متعلق به شخص دیگری است اعلام کنید">
                            </div>

                        </div>
                        <div class="form-group">
                        <div class="col-md-4 col-sm-12 col-md-offset-7">
                            <button type="submit" class="btn btn-success btn-block" >Submit</button>
                        </div>
                        </div>
                    </div>
                        <div class="panel-footer">

                        </div>
                    </div>
                </form>
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


