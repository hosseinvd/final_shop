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
        <div class="row">
            @if(!empty($user_info)&&($user_info->national_code!=1))
                <div class="col-md-6">
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
            @else
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            اطلاعات کاربری
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <h4>لطفا اطلاعات تکمیلی ثبت نام خود را هرچه زودتر وارد نمایید</h4>
                                <div class="col-xs-12 col-sm-4 text-center">
                                    <i class="fa fa-user fa-5x" aria-hidden="true"></i>
                                </div><!--/col-->
                                <div class="col-xs-12 col-sm-8">
                                    <h2>{{Auth::user()->name}}</h2>
                                    <p><strong>کد ملی :</strong> ? </p>
                                    <p><strong>آدرس :</strong> ? </p>
                                    <p><strong>کدپستی :</strong> ? </p>
                                    <p><strong>پست الکترونیکی :</strong> {{Auth::user()->email}} </p>
                                    <p><strong>نوع کاربر </strong>
                                        <span class="label label-danger"> اطلاعات کاربری ناقص </span>
                                    </p>
                                </div><!--/col-->
                            </div><!--/row-->
                        </div><!--/panel-body-->
                        <div class="panel-footer">
                            <a href="{{route('enter_user_info')}}"><i class="fa fa-plus fa-2x" aria-hidden="true"></i>ورود
                                اطلاعات </a>
                        </div>
                    </div><!--/panel-->

                </div>
            @endif
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-xs-12 col-sm-8">
                            <h2>شما زیر مجموعه </h2>
                            <p><strong>کاربر: </strong> {{$user_info->seller->family}} </p>
                            @if(count($user_info->resellers)>0)
                                <h2>زیر مجموعه های شما </h2>
                                <p><strong> کاربر: </strong>
                                    @foreach($user_info->resellers as $reseller)
                                        {{$reseller->family}},
                                    @endforeach
                                </p>
                            @endif

                        </div><!--/col-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th> کد تخفیف</th>
                                    <th>درصد پورسانت</th>
                                    <th>درصد تخفیف به مشتری</th>
                                    <th>مدل محاسبه تخفیف</th>
                                    <th>تعداد باقی مانده</th>
                                    <th>شروع اعتبار</th>
                                    <th>پایان اعتبار</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>
                                @foreach($user_discounts as $user_discount)
                                    @if(!empty($user_discount))
                                        @if(strcmp($user_discount->type,'reseller_Discount')==0)
                                            <tr>
                                                <?php $i++; ?>
                                                <td>{{$i}}</td>
                                                <td>{{$user_discount->code}}</td>
                                                <td>{{$user_discount->commission}}</td>
                                                <td>{{$user_discount->percent}} </td>
                                                <td>{{$user_discount->calc_mode}} </td>
                                                <td>{{$user_discount->numbers}}</td>
                                                <td> {{jdate($user_discount->start_date)->format('%d %B، %Y')}}</td>
                                                <td>{{jdate($user_discount->end_date)->format('%d %B، %Y')}}</td>
                                                @endif
                                                @else
                                                    <h2>کاربر گرامی برای شما کدی تعریف نگردیده است</h2>
                                        @endif
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection