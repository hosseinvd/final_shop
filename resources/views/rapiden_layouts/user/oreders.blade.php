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
                    <li class="active">سفارشات</li>
                </ol>
            </div>
        </div>

            <div id="basket_table" id="accordion">
                <div class="table-content table-responsive">
                    <div class="panel-group" id="accordion">
                        <?php $i = 0; ?>
                        <div class="panel panel-default">
                            @if(count($orders)==0)
                                <h3>سفارشی ثبت نشده است</h3>
                            @endif
                            @foreach($orders as $order)
                                <?php $i++; ?>

                                <div class="panel-body">
                                    <table class="table table-responsive table-hover">
                                        @if($i==1)
                                            <thead>
                                            <tr class="success">
                                                <th style="width:5%">ردیف</th>
                                                <th class="product-thumbnail" style="width:5%">کد </th>
                                                <th class="product-name" style="width:15%">تاریخ سفارش</th>
                                                <th class="product-quantity" style="width:30%">گیرنده</th>
                                                <th class="product-quantity" style="width:15%">مبلغ</th>
                                                <th class="product-quantity" style="width:10%">وضعیت</th>
                                                <th class="product-quantity" style="width:20%">جزئیات</th>

                                            </tr>
                                            </thead>
                                        @endif
                                        <tbody>
                                        <tr>
                                            <td style="width:10%">{{$i}}</td>
                                            <td class="product-thumbnail" style="width:5%">
                                                {{$order->id}}
                                            </td>
                                            <td class="product-name" style="width:15%">
                                                {{jdate($order->created_at)->format('date')}}
                                            </td>
                                            <td class="product-quantity" style="width:30%">
                                                {{$order->users_address->address}}
                                            </td>
                                            <td class="product-quantity" style="width:15%">
                                                {{$order->baskets->first()->paid}}
                                            </td>
                                            <td style="width:10%">
                                                <i class="fa fa-truck fa-2x" aria-hidden="true"></i>
                                            </td>
                                            <td style="width:20%">
                                                <a data-toggle="collapse" data-parent="#accordion"
                                                   href="#collapse{{$i}}">جزئیات سفارش <i class="fa fa-arrow-circle-down fa-2x" aria-hidden="true"></i> </a>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="collapse{{$i}}" class="panel-collapse collapse">
                                    <div class="panel-heading">
                                        <p class="bg-info" style="text-align: center">جزئیات سفارش  <a><i class="fa fa-print " aria-hidden="true"></i></a>   </p>
                                    </div>
                                    @foreach($order->baskets as $basket)
                                    <div class="panel-body">
                                        <div class="table-content table-responsive">

                                            <table class="table table-responsive table-hover">
                                                <thead>
                                                @if($basket->children_id!=0)
                                                    <tr class="info">
                                                @else
                                                    <tr class="warning">
                                                @endif
                                                    <th>ردیف</th>
                                                    <th class="product-thumbnail">عنوان</th>
                                                    <th class="product-name">تعداد</th>
                                                    <th class="product-name">قیمت</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($basket->stuffs as $index=>$stuff)
                                                    <tr>
                                                        <td>{{$index+1}}</td>
                                                        <td>{{$stuff->product->title}}</td>
                                                        <td>{{$stuff->qty}}</td>
                                                        <td>{{$stuff->price}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        <div class="row">
                                            <div class="col-md-1 col-sm-1 col-xs-12">
                                            </div>
                                            <div class="col-md-7 col-sm-5 col-xs-12">
                                                <div class="coupon">
                                                    <input type="hidden" name="address_id"
                                                           value="{{$order->users_address->id}}">
                                                    {{--<h3>{{$order->users_address->name_family}}</h3>--}}
                                                    {{--<p>{{$order->users_address->address}}</p>--}}
                                                    {{--<p>{{$order->users_address->mobile_number}}</p>--}}
                                                    <p>{{$order->address}}</p>
                                                    @if($basket->children_id==0)
                                                        @if($basket->paid>0)
                                                        <p><a href="{{route('user-refund_basket',$basket->id)}}"><i class="fa fa-reply fa-3x" aria-hidden="true"></i>
                                                           </a></p>
                                                        @endif
                                                    @else
                                                        <p><a href="{{route('user-refund_basket',$basket->id)}}"><i class="fa fa-history fa-3x" aria-hidden="true"></i>
                                                           </a></p>
                                                    @endif
                                                    <p><a href="{{route('user_basket_cheques',$basket->id)}}"><i class="fa fa-money fa-2x" aria-hidden="true"></i>لیست پرداختها </a></p>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-5 col-xs-12">
                                                <div class="cart_totals">
                                                    <table>
                                                        <tbody>
                                                        <tr class="cart-subtotal">
                                                            <th>بهای خالص</th>
                                                            <td><span class="amount">{{$basket->price}}
                                                                    <small>تومان</small></span></td>
                                                        </tr>
                                                        <tr class='cart-subtotal'>
                                                            <th>تخفیف</th>
                                                            <td>
                                                                <input type="hidden" name="discount_id"
                                                                       value="{{session()->get('discount_id')}}">
                                                                <input type="hidden" name="discount_code"
                                                                       value="{{session()->get('discount_code')}}">
                                                                <strong><span class='amount'>{{$basket->total_discount}}
                                                                        <small>تومان</small></span></strong>
                                                            </td>
                                                        </tr>
                                                        <tr class="cart-subtotal">
                                                            <th>مالیات</th>
                                                            <td><span class="amount">{{$basket->tax}}
                                                                    <small>تومان</small></span></td>
                                                        </tr>
                                                        <tr class="cart-subtotal">
                                                            <th>جمع</th>
                                                            <td>
                                                                <strong><span class="amount">{{$basket->price+$basket->tax}}
                                                                        <small>تومان</small></span></strong>
                                                            </td>
                                                        </tr>

                                                        <tr class='order-total'>
                                                            <th> مبلغ محاسبه شده</th>
                                                            <td>
                                                                <strong><span class='amount'>{{$basket->paid}}
                                                                        <small>تومان</small></span></strong>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                            <div >
                                                @if($basket->children_id!=0)
                                                    <p class="bg-info" style="text-align: center">{{jdate($basket->created_at)->format('%B %d، %Y').'     ----  ساعت : '.jdate($basket->created_at)->format('time')}}</p>
                                                @else
                                                    <p class="bg-warning" style="text-align: center">{{jdate($basket->created_at)->format('%B %d، %Y').'     ----  ساعت : '.jdate($basket->created_at)->format('time')}}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                            @endforeach

                        </div>
                    </div>


                </div>
            </div>
    </div>




@endsection




