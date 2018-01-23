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
                            <th>refresh</th>
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
                                <td>
                                    <button type="button" class="btn btn-warning " id="refresh" value="{{$i}}"><i
                                                class="fa fa-refresh" aria-hidden="true"></i></button>
                                </td>
                                <td class="product-price">{{$stuff->price}}</td>
                                <td class="product-price">{{$stuff->discount*$stuff->price}}</td>
                                <td class="product-price">{{$stuff->qty}}</td>

                                    {{--<td class="product-price">{{$stuff->tax}}</td>--}}
                                <td class="product-quantity">
                                    <input class="form-control" id="row_id_{{$i}}" type="hidden" name="row_id[]"
                                           value="{{$stuff->id}}">
                                    <input class="form-control row_qty" id="row_qty_{{$i}}" type="number"  min="0" max="{{$stuff->qty}}"
                                           name="row_qty[]"
                                           value="{{$stuff->qty}}">
                                </td>
                                <td class="product-subtotal">{{(1-$stuff->discount)*($stuff->price*$stuff->qty)}}</td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <p class="bg-danger">* توجه در صورت تائید بازگشت کالا مقدار پرداختی شما برای مالیات محاسبه نشده همچنین مبلغ پرداختی شما با احتساب کد تخفیف مورد محاسبه قرار می گیرد.</p>

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

                    $(document).on('click', '#discount', function (event) {
                        CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        var _method = 'PUT';
                        var code=$("#discount_code").val();
                        $.post("{{route('updateCart')}}", {
                            request_name: "calc_discount",
                            'code': code,
                            _token: CSRF_TOKEN,
                            _method: _method,
                        }, function (data) {
                            $("#pay_value").html(data);
                        });

                    });

                    $(document).on('click', '#delete_row', function (event) {
                        CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        var _method = 'DELETE';
                        var rowId = $(this).attr("value");
                        swal({
                                title: "آیا از عملیات حذف مطمئن هستید",
                                text: "عملیات حذف محصول",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "بله ",
                                cancelButtonText: "لغو عملیات",
                                closeOnConfirm: false,
                                closeOnCancel: false
                            },
                            function (isConfirm) {
                                if (isConfirm) {
                                    $.post("{{route('updateCart')}}", {
                                        request_name: "basket_delete",
                                        'rowId': rowId,
                                        _token: CSRF_TOKEN,
                                        _method: _method,
                                    }, function (data) {
                                        $("#basket_table").html(data);
                                    });
                                    swal("حذف", "عملیات حذف با موفقیت پایان یافت", "success");
                                } else {
                                    swal("لغو", "عملیات لغو گردید", "error");
                                }
                            });

                    });
                });

            </script>
@endsection

