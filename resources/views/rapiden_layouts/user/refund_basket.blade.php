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
                    <li class="active">بازگشت محصول</li>
                </ol>
            </div>
        </div>
        <form class="form-horizontal" method="post" action="{{route('user-refund_stuffs')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <input  type="hidden" name="basket_id" value="{{$basket->id}}">
            <div id="basket_table">
                <div class="table-content table-responsive">
                    <table>
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th class="product-thumbnail">تصویر</th>
                            <th class="product-name">محصول</th>
                            <th class="product-price">قیمت خالص</th>
                            <th class="product-price"> تخفیف محاسبه شده</th>
                            {{--<th class="product-price">مالیات</th>--}}
                            <th class="product-quantity"> تعداد خریداری شده</th>
                            <th class="product-quantity"> تعداد جدید</th>
                            <th class="product-subtotal">جمع</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; ?>
                        @foreach($basket->stuffs as $stuff)
                            <tr>
                                <?php $i++; ?>
                                <td>{{$i}}</td>
                                <td class="product-thumbnail">
                                    @if(($stuff->product->images()->exists()))
                                        <img src="{{asset('product_image').'/'.$stuff->product->images()->first()->imagePath}}"
                                             alt="...">
                                    @else
                                        <img src="{{asset('images/picture-not-available.jpg')}}"
                                             alt="...">
                                    @endif

                                </td>
                                {{--<td>{{$stuff->rowId}}</td>--}}
                                <td class="product-name">
                                    <a href="{{route('show_product',$stuff->product->id)}}">
                                        <p><strong>{{$stuff->product->title}}</strong></p>
                                    </a>
                                </td>

                                <td class="product-price">{{$stuff->price}}</td>
                                <td class="product-price">{{$stuff->discount*$stuff->price}}</td>
                                <td class="product-price">{{$stuff->qty}}</td>

                                    {{--<td class="product-price">{{$stuff->tax}}</td>--}}
                                <td class="product-quantity">
                                    <input class="form-control" id="row_id_{{$i}}" type="hidden" name="stuff_id[]"
                                           value="{{$stuff->id}}">
                                    <input class="form-control row_qty" id="row_qty_{{$i}}" type="number"  min="0" max="{{$stuff->qty}}"
                                           name="stuff_qty[]"
                                           value="{{$stuff->qty}}">
                                </td>
                                <td class="product-subtotal">{{(1-$stuff->discount)*($stuff->price*$stuff->qty)}}</td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-1 col-sm-1 col-xs-12">
                        </div>
                        <div class="col-md-7 col-sm-5 col-xs-12">

                        </div>
                        <div class="col-md-3 col-sm-5 col-xs-12">
                            <div class="cart_totals">
                                <table>
                                    <tbody>
                                    <tr class="cart-subtotal">
                                        <th>بهای خالص</th>
                                        <td><span class="amount">{{$stuff->basket->price}}
                                                <small>تومان</small></span></td>
                                    </tr>
                                    <tr class='cart-subtotal'>
                                        <th>تخفیف</th>
                                        <td>
                                            {{--//$stuff->basket->price--}}
                                            <input type="hidden" name="discount_id"
                                                   value="{{session()->get('discount_id')}}">
                                            <input type="hidden" name="discount_code"
                                                   value="{{session()->get('discount_code')}}">
                                            <strong><span class='amount'>{{$stuff->basket->total_discount}}
                                                    <small>تومان</small></span></strong>
                                        </td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <th>مالیات</th>
                                        <td><span class="amount">
                                                {{$stuff->basket->tax}}<small>تومان</small></span></td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <th>جمع</th>
                                        <td>
                                            <strong><span class="amount">{{$stuff->basket->price-$stuff->basket->total_discount}}
                                                    <small>تومان</small></span></strong>
                                        </td>
                                    </tr>

                                    <tr class='order-total'>
                                        <th> مبلغ محاسبه شده</th>
                                        <td>
                                            <strong><span class='amount'>{{$stuff->basket->paid}}
                                                    <small>تومان</small></span></strong>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="wc-proceed-to-checkout">
                        <input type="submit" value="ثبت تغییرات">
                    </div>

                </div>
                <p class="bg-danger">* توجه در صورت تائید بازگشت کالا مقدار پرداختی شما به عنوان مالیات محاسبه نشده و همچنین مبلغ پرداختی شما با احتساب کد تخفیف مورد محاسبه قرار می گیرد.</p>

            </div>
        </form>
    </div>
@endsection



