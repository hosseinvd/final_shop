@extends('rapiden_layouts.master')
@section('title','Larvel Shopping Cart')

@section('header')
    @include('rapiden_layouts.partials.user_header')
@endsection

@section('mainmenu')
    @include('rapiden_layouts.partials.mainmenu')
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
        <form class="form-horizontal" method="post" action="{{route('update_full_basket')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div id="basket_table">
            <div class="table-content table-responsive" >
                <table>
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th class="product-thumbnail">تصویر</th>
                        <th class="product-name">محصول</th>
                        <th class="product-quantity">تعداد</th>
                        <th>refresh</th>
                        <th class="product-price">قیمت</th>
                        <th class="product-subtotal">جمع</th>
                        <th class="product-remove">حذف</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; ?>
                    @foreach(Cart::content() as $row)
                        <tr>
                            <?php $i++; ?>
                            <td>$i</td>
                            <td class="product-thumbnail">
                                <img  src="{{asset('product_image').'/'.\App\Product::find($row->id)->images()->first()->imagePath}}"
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
                                <input class="form-control row_qty" id="row_qty_{{$i}}" type="number" name="row_qty[]"
                                       value="{{$row->qty}}">
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning " id="refresh" value="{{$i}}"><i
                                            class="fa fa-refresh" aria-hidden="true"></i></button>
                            </td>
                            <td class="product-price">{{$row->price}}</td>
                            {{--<td>{{$row->qty*$row->tax}}</td>--}}
                            <td class="product-subtotal">{{$row->subtotal}}</td>
                            <td class="product-remove"><a href="#"><i class="fa fa-times"></i></a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <div class="row">
                        <div class="col-md-9 col-sm-7 col-xs-12">
                            <div class="buttons-cart">
                                <input type="submit" value="به روز رسانی سبد">
                                <a href="{{route('products')}}">ادامه خرید</a>
                                {{--<button type="submit" class="btn btn-success btn-block">refresh all</button>--}}

                            </div>
                            <div class="coupon">
                                <h3>کد تخفیف</h3>
                                <p>کد تخفیف خود را در صورت وجود وارد نمایید</p>
                                <input type="text" placeholder="کد تخفیف">
                                <input type="submit" value="اعمال تخفیف">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-5 col-xs-12">
                            <div class="cart_totals">
                                <h2>مجموع سبد</h2>
                                <table>
                                    <tbody>
                                    <tr class="cart-subtotal">
                                        <th>زیر مجموعه</th>
                                        <td><span class="amount"><?php echo Cart::subtotal(); ?> <small>تومان</small></span></td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <th>مالیات</th>
                                        <td><span class="amount"><?php echo Cart::tax(); ?> <small>تومان</small></span></td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>جمع</th>
                                        <td>
                                            <strong><span class="amount"><?php echo Cart::total(); ?> <small>تومان</small></span></strong>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
            </div>
            </div>
        </form>

            <form class="form-horizontal" method="post" action="{{route('Gateway-Request')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" class="form-control" name="total_price" value="{{Cart::total()}}">

                <div class="wc-proceed-to-checkout">
                    <button type="submit" class="btn btn-info ">pay</button>
                </div>

            </form>


        @endsection

        @section('scripts')
            <script type="text/javascript">

                $(document).ready(function () {

                    $(document).on('click', '#refresh', function (event) {
                        CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        var _method = 'PATCH';
                        var id = $(this).attr("value");
                        var row_id = $("#row_id_" + id).val();
                        var row_qty = $("#row_qty_" + id).val();
                        if (isNaN(parseInt(row_qty, 10))) {
                            alert("Input not valid");
                        } else {
                            $.post("{{route('updateCart')}}", {
                                request_name: "basket_update",
                                'id': id,
                                'row_id': row_id,
                                'row_qty': row_qty,
                                _token: CSRF_TOKEN,
                                _method: _method,
                            }, function (data) {
                                $("#basket_table").html(data);
                            });
                        }
                    });

                });

            </script>
@endsection

