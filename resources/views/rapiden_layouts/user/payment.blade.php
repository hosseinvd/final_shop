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
                    <li class="active">سبد خرید</li>
                </ol>
            </div>
        </div>
        <form class="form-horizontal" method="post" action="{{route('update_full_basket')}}"
              enctype="multipart/form-data">
            {{csrf_field()}}
            <div id="basket_table">
                <div class="table-content table-responsive">
                    <table>
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th class="product-thumbnail">تصویر</th>
                            <th class="product-name">محصول</th>
                            <th class="product-quantity">تعداد</th>
                            <th class="product-price">قیمت</th>
                            <th class="product-subtotal">جمع</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; ?>
                        @foreach(Cart::content() as $row)
                            <tr>
                                <?php $i++; ?>
                                <td>{{$i}}</td>
                                <td class="product-thumbnail">
                                    <img src="{{asset('product_image').'/'.\App\Product::find($row->id)->images()->first()->imagePath}}"
                                         alt="...">
                                </td>
                                {{--<td>{{$row->rowId}}</td>--}}
                                <td class="product-name">
                                    <a href="{{route('show_product',$row->id)}}">
                                        <p><strong>{{$row->name}}</strong></p>
                                    </a>
                                </td>
                                <td class="product-quantity">
                                    <input class="form-control" id="row_id_{{$i}}" type="hidden" name="row_id[]"
                                           value="{{$row->rowId}}">
                                    {{$row->qty}}
                                </td>
                                <td class="product-price">{{$row->price}}</td>
                                {{--<td>{{$row->qty*$row->tax}}</td>--}}
                                <td class="product-subtotal">{{$row->subtotal}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-9 col-sm-7 col-xs-12">
                        <div class="coupon">
                            <h3>{{$address->name_family}}</h3>
                            <p>{{$address->address}}</p>
                            <p>{{$address->mobile_number}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-5 col-xs-12">
                        <div class="cart_totals">
                            <h2>مجموع سبد</h2>
                            <table>
                                <tbody>
                                <tr class="cart-subtotal">
                                    <th>زیر مجموعه</th>
                                    <td><span class="amount"><?php echo Cart::subtotal(); ?>
                                            <small>تومان</small></span></td>
                                </tr>
                                <tr class="cart-subtotal">
                                    <th>مالیات</th>
                                    <td><span class="amount"><?php echo Cart::tax(); ?>
                                            <small>تومان</small></span></td>
                                </tr>
                                <tr class="order-total">
                                    <th>جمع</th>
                                    <td>
                                        <strong><span class="amount"><?php echo Cart::total(); ?>
                                                <small>تومان</small></span></strong>
                                    </td>
                                </tr>
                                <tr class='order-total'>
                                    <th>تخفیف</th>
                                    <td>
                                        <strong><span class='amount'>{{session()->get('discount')}} <small>تومان</small></span></strong>
                                    </td>
                                </tr>
                                <tr class='order-total'>
                                    <th>مبلغ قابل پرداخت</th>
                                    <td>
                                        <strong><span class='amount'>{{Cart::total()-Session::get('discount')}} <small>تومان</small></span></strong>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="wc-proceed-to-checkout">
                                <a href="{{route('user-checkout')}}">پرداخت</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{--<form class="form-horizontal" method="post" action="{{route('Gateway-Request')}}" enctype="multipart/form-data">--}}
        {{--{{csrf_field()}}--}}
        {{--<input type="hidden" class="form-control" name="total_price" value="{{Cart::total()}}">--}}

        {{--<div class="wc-proceed-to-checkout">--}}
        {{--<button type="submit" class="btn btn-info ">pay</button>--}}
        {{--</div>--}}

        {{--</form>--}}


        @endsection




