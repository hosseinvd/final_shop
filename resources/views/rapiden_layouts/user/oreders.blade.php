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
        <form class="form-horizontal" method="post" action="{{route('update_full_basket')}}"
              enctype="multipart/form-data">
            {{csrf_field()}}
            <div id="basket_table" id="accordion">
                <div class="table-content table-responsive">
                    <div class="panel-group" id="accordion">
                            <?php $i = 0; ?>
                            @foreach($orders as $order)
                                <?php $i++; ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <table class="table table-responsive table-hover">
                                            @if($i==1)
                                            <thead>
                                            <tr>
                                                <th>ردیف</th>
                                                <th class="product-thumbnail">کد سفارش</th>
                                                <th class="product-name">تاریخ سفارش</th>
                                                <th class="product-quantity">وضعیت</th>
                                                <th class="product-quantity">جزئیات</th>
                                            </tr>
                                            </thead>
                                            @endif
                                            <tbody>
                                        <tr>
                                            <td><a data-toggle="collapse" data-parent="#accordion"
                                                   href="#collapse{{$i}}">Collapsible{{$i}}</a></td>
                                            <td class="product-thumbnail">
                                                {{$order->id}}
                                            </td>
                                            <td class="product-name">
                                                {{$order->created_at}}
                                            </td>
                                            <td class="product-quantity">
                                                {{$order->users_address->address}}
                                            </td>
                                            <td>
                                                {{$order->basket->stuffs->first()->product->title}}
                                            </td>
                                        </tr>
                                            </tbody>
                                        </table>

                                    </div>

                    <div id="collapse{{$i}}" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <table class="table table-responsive table-hover">
                                                <thead>
                                                <tr>
                                                    <th>ردیف</th>
                                                    <th class="product-thumbnail">عنوان</th>
                                                    <th class="product-name">تعداد</th>
                                                    <th class="product-quantity">مالیات</th>
                                                    <th class="product-quantity">تخفیف</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($order->basket->stuffs as $stuff)
                                                    <tr>
                                                        <td>{{$stuff->product->title}}</td>
                                                        <td>{{$stuff->qty}}</td>
                                                        <td>{{$stuff->price}}</td>
                                                        <td>{{$stuff->tax}}</td>
                                                        <td>{{$stuff->discount}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                </div>


                </div>
            </div>
        </form>




@endsection

{{--@foreach($orders as $order)--}}
{{--<?php $i++; ?>--}}
{{--<tr class="clickable" data-toggle="collapse" id="row{{$i}}" data-target=".row{{$i}}">--}}

{{--<td><i class="glyphicon glyphicon-plus"></i></td>--}}
{{--<td class="product-thumbnail">--}}
{{--{{$order->id}}--}}
{{--</td>--}}
{{--<td class="product-name">--}}
{{--{{$order->created_at}}--}}
{{--</td>--}}
{{--<td class="product-quantity">--}}
{{--{{$order->users_address->address}}--}}
{{--</td>--}}
{{--<td>--}}
{{--{{$order->basket->stuffs->first()->product->title}}--}}
{{--</td>--}}
{{--</tr>--}}
{{--@foreach($order->basket->stuffs as $stuff)--}}
{{--<tr class="collapse row{{$i}}">--}}
{{--<td>{{$stuff->product->title}}</td>--}}
{{--<td>{{$stuff->qty}}</td>--}}
{{--<td>{{$stuff->price}}</td>--}}
{{--<td>{{$stuff->tax}}</td>--}}
{{--<td>{{$stuff->discount}}</td>--}}
{{--</tr>--}}
{{--@endforeach--}}

{{--@endforeach--}}


