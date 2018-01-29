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
                    <li class="active">گزارش مالی</li>
                </ol>
            </div>
        </div>
        <div id="basket_table" id="accordion">
            <div class="table-content table-responsive">
                <div class="panel-group" id="accordion">
                    <?php $i = 0; ?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-responsive table-hover">
                            <thead>
                            <tr class="success">
                                <th style="width:5%">ردیف</th>
                                <th class="product-name" style="width:15%">نوع</th>
                                <th class="product-quantity" style="width:30%">تاریخ</th>
                                <th class="product-quantity" style="width:15%">واریز کننده</th>
                                <th class="product-quantity" style="width:15%">واریز به</th>
                                <th class="product-thumbnail" style="width:5%">مقدار</th>
                                <th class="product-quantity" style="width:20%">کد خرید</th>
                            </tr>
                            </thead>
                                <tbody>
                        @foreach($bank_interactions as $bank_interaction)
                            <?php $i++; ?>

                                    <tr>
                                        <td style="width:10%">{{$i}}</td>
                                        <td class="product-quantity" style="width:30%">
                                            @if($bank_interaction->type==1)
                                     خرید توسط کد بازاریابی شخصی
                                            @elseif($bank_interaction->type==2)
                                                شارژ مستقیم حساب
                                            @elseif($bank_interaction->type==3)
                                                دریافتی از زیر مجموعه
                                            @elseif($bank_interaction->type==4)
                                                پرداخت به نماینده
                                            @endif
                                        </td>
                                        <td class="product-date" style="width:15%">
                                            {{jdate($bank_interaction->created_at)->format('date')}}
                                        </td>

                                        <td class="product-quantity" style="width:15%">
                                            {{$bank_interaction->payer->name.' '.$bank_interaction->payer->family}}
                                        </td>
                                        <td class="product-quantity" style="width:15%">
                                            {{$bank_interaction->pay_to->name.' '.$bank_interaction->pay_to->family}}
                                        </td>
                                        <td class="product-thumbnail" style="width:5%">
                                            {{$bank_interaction->money}}
                                        </td>
                                        <td style="width:20%">

                                            {{$bank_interaction->basket->order->id}}

                                        </td>
                                    </tr>


                        @endforeach
                        <tr>
                            <td style="width:10%"></td>
                            <td class="product-quantity" style="width:30%">

                            </td>
                            <td class="product-date" style="width:15%">

                            </td>
                            <td class="product-date" style="width:15%">

                            </td>
                            <td class="product-quantity" style="width:15%">
جمع
                            </td>
                            <td class="product-thumbnail" style="width:5%">
                                {{$bank_interactions->sum('money')}}
                            </td>
                            <td style="width:20%">
                            </td>
                        </tr>
                             </tbody>
                                </table>
                            </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection





