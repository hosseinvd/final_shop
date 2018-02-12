@extends('admin.layouts.admin_master')
@section('title','Orders')


@section('content')
    <div class="container">
        <div class="breadcrumb-area">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="{{route('a_Dashboard')}}"><i class="fa fa-home"></i> داشبورد</a></li>
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
                                                <th class="product-thumbnail" style="width:5%">کاربر </th>
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
                                                {{$order->info_user->family}}
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
                                <div id="collapse{{$i}}" class="panel-collapse collapse ">
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
                                        <div class="row  ">
                                            <div class="col-md-1 col-sm-1 col-xs-12">
                                            </div>
                                            <div class="col-md-7 col-sm-5 col-xs-12">
                                                <div class="coupon">
                                                    @if($basket->basket_type==0)
                                                    <div id="refresh_address_{{$basket->id}}">
                                                        <input type="hidden"   id="basket_id_{{$order->users_address->id}}" value="{{$basket->id}}">

                                                        <input type="hidden" name="address_id"  value="{{$order->users_address->id}}">
                                                        <input type="hidden"   id="name_family_{{$order->users_address->id}}"
                                                               value="{{$order->users_address->name_family}}">
                                                        <input type="hidden"   id="mobile_number_{{$order->users_address->id}}"
                                                               value="{{$order->users_address->mobile_number}}">
                                                        <input type="hidden"   id="address_{{$order->users_address->id}}"
                                                               value="{{$order->users_address->address}}">
                                                        <h3>{{$order->users_address->name_family}}</h3>
                                                        <p>{{$order->users_address->address}}
                                                            <button type="button" class="btn our_button_e"
                                                                    id="{{$order->users_address->id}}" data-toggle="modal"
                                                                    data-target="#myModal"><i class="fa fa-edit"></i>
                                                            </button>
                                                        </p>
                                                        <p>{{$order->users_address->mobile_number}}</p>

                                                    </div>
                                                        @else
                                                        <h3>سبد مرجوعی </h3>
                                                        <br>
                                                    @endif
                                                    <p>
                                                     <button type="button" class="btn btn-success approve_basket" id="{{$basket->id}}"> <i class="fa fa-thumbs-up"></i>تائید </button>
                                                     <button type="button" class="btn btn-danger disapprove_basket" id="{{$basket->id}}"><i class="fa fa-thumbs-down"></i>لغو </button>
                                                    </p>
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
                                                            <th> مبلغ محاسبه شده : </th>
                                                            <td>
                                                                <strong><span class='amount'>{{$basket->paid}}
                                                                        <small>تومان</small></span></strong>
                                                            </td>
                                                        </tr>
                                                        <tr class='order-total'>
                                                            <th>وضعیت</th>
                                                            <td>
                                                                <div id="refresh_status_{{$basket->id}}">

                                                                @if($basket->status==0)
                                                                    <p class="text-danger"><i class="fa fa-thumbs-down fa-2x"></i></p>
                                                                @elseif($basket->status==2)
                                                                    <p class="text-success"><i class="fa fa-thumbs-up fa-2x"></i></p>
                                                                @endif
                                                                </div>
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

        {{ $orders->links() }}

    </div>


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="title">ویرایش آدرس </h4>
                </div>
                <div class="modal-body">
                    <label for="usr"> نام گیرنده </label>
                    <input type="text" class="form-control" id="name_family_m">
                    <input type="hidden" class="form-control" id="address_id_m">
                    <label for="pwd">آدرس</label>
                    <input type="text" class="form-control" id="address_m">
                    <label for="pwd">تلفن گیرنده</label>
                    <input type="text" class="form-control" id="mobile_number_m">
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-block" id="edit_address_m" data-dismiss="modal">
                        ثبت
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('scripts')
    <script type="text/javascript">

        $(document).ready(function () {
            $(document).on('click', '.our_button_e', function (event) {
                var id = $(this).attr("id");
                var mobile_number = $("#mobile_number_" + id).val();
                var name_family = $("#name_family_" + id).val();
                var address = $("#address_" + id).val();
                $("#mobile_number_m").val(mobile_number);
                $("#name_family_m").val(name_family);
                $("#address_m").val(address);
                $("#address_id_m").val(id);
            });


            $(document).on('click', '#edit_address_m', function (event) {
                CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var _method = 'PATCH';
                var address_id = $("#address_id_m" ).val();
                var mobile_number = $("#mobile_number_m" ).val();
                var name_family = $("#name_family_m").val();
                var address = $("#address_m").val();
                var basket_id = $("#basket_id_" + address_id).val();
                $.post("/admin/Orders", {
                    'address_id': address_id,
                    'mobile_number': mobile_number,
                    'name_family': name_family,
                    'address':address,
                    _token: CSRF_TOKEN,
                    _method: _method,
                }, function (data) {
                    $("#refresh_address_" + basket_id).load(location.href + ' #refresh_address_'+ basket_id);
                });
            });

            $(document).on('click', '.approve_basket', function (event) {
                var basket_id = $(this).attr("id");
                CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var _method = 'PUT';
                $.post("/admin/Orders", {
                    'basket_id': basket_id,
                    _token: CSRF_TOKEN,
                    _method: _method,
                }, function (data) {
                    $("#refresh_status_" + basket_id).load(location.href + ' #refresh_status_'+ basket_id);
                });
            });

            $(document).on('click', '.disapprove_basket', function (event) {
                var basket_id = $(this).attr("id");
                CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var _method = 'DELETE';
                $.post("/admin/Orders", {
                    'basket_id': basket_id,
                    _token: CSRF_TOKEN,
                    _method: _method,
                }, function (data) {
                    $("#refresh_status_" + basket_id).load(location.href + ' #refresh_status_'+ basket_id);
                });
            });


            $("#add_new_icon").click(function (event) {
                $("#add_item").val(" ");
                $("#title").text("add new item");
                $("#delete_item").hide("400");
                $("#save_item").hide("400");
                $("#add_btn").show();
            });

            $('#add_category').click(function (event) {
                CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var name = $("#Category_name").val();
                var description = $("#Category_description").val();
                var category_id=$("#category_id").val();
                $.post("/admin/CreateProductCategory", {
                    'name': name,
                    'description': description,
                    'category_id':category_id,
                    _token: CSRF_TOKEN
                }, function (data) {
                    $('#C_table').load(location.href + ' #C_table');
                });
            })
        });

    </script>
@endsection



