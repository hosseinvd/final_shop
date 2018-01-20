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
                    <li class="active">نظرات</li>
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
                            <th class="product-thumbnail">نظر</th>
                            <th class="product-name">تاریخ</th>
                            <th class="product-quantity">وضعیت</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; ?>
                        @foreach($comments as $comment)
                            <tr>
                                <?php $i++; ?>
                                <td class="product-remove">{{$i}}</td>
                                <td class="product-name">
                                    <p>
                                        {{$comment->comment}}
                                    </p>
                                </td>
                                <td class="product-name">
                                    {{$comment->created_at}}
                                </td>
                                <td class="product-quantity">
                                    @if($comment->approved==0)
                                        <i class="fa fa-hourglass-half" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                    @endif
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
@endsection