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
            <div id="basket_table">
                <div class="table-content table-responsive">
                    <table>
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th class="product-thumbnail">کد سفارش</th>
                            <th class="product-name">تاریخ سفارش</th>
                            <th class="product-quantity">وضعیت</th>
                            <th class="product-quantity">جزئیات</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; ?>

                        @foreach($orders as $order)
                            <tr>
                                <?php $i++; ?>
                                <td>{{$i}}</td>
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
                        @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </form>




        @endsection



