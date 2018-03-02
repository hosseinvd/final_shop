@extends('rapiden_layouts.master')
@section('title','Larvel Shopping Cart')

@section('category_sidebar')
    @include('rapiden_layouts.partials.category_sidebar')
@endsection

@section('mainmenu')
    @include('rapiden_layouts.partials.mainmenu')
@endsection

@section('header')
    @include('rapiden_layouts.partials.main_header')
@endsection

@section('slider-area')
    @include('rapiden_layouts.partials.slider-area')
@endsection

@section('scripts')
    {!! NoCaptcha::renderJs('fa', false, 'recaptchaCallback') !!}
    {{--    {!! NoCaptcha::renderJs() !!}--}}
@endsection

@section('content')

    <div class="new-product-area dotted-style-2">
        <div class="section-title">
            <h3>محصولات </h3>
        </div>
        <div class="new-product-active border-1 owl-carousel">

            @foreach($products->chunk(3) as $productChunk)
                <div class="new-product-items">
                    @foreach($productChunk as $product)
                        <div class="single-product  white-bg">
                            <div class="product-img pt-20">
                                <a href="{{route('show_product',$product->id)}}">
                                    @if(($product->images()->exists()))
                                        <img src="{{asset('product_image').'/'.$product->images()->first()->imagePath}}"
                                         alt="...">
                                    @else
                                        <img src="{{asset('images/picture-not-available.jpg')}}"
                                             alt="...">
                                    @endif
                                </a>
                            </div>
                            <div class="product-content product-i">
                                <div class="pro-title">
                                    <h4><a href="{{route('show_product',$product->id)}}">{{$product->title}}</a></h4>
                                </div>
                                {{--<div class="pro-rating ">--}}
                                    {{--<a href="#"><i class="fa fa-star"></i></a>--}}
                                {{--</div>--}}
                                <div class="price-box">
                                    <span class="price product-price">{{$product->price}} <small>تومان</small></span>

                                    {{--<span class="old-price product-price"><del>{{$product->price}}</del></span>--}}
{{--                                    <span class="price product-price">{{$product->price-((($product->discount)/100)*$product->price)}} <small>تومان</small></span>--}}
                                </div>
                                <div class="product-icon">
                                    <div class="product-icon-right f-right">
                                        @if($product->inventory>0)
                                        <a href="{{route('addToCart',$product->id)}}"><i
                                                    class="fa fa-shopping-cart"></i>افزودن
                                            به سبد</a>
                                            @else
                                            موجود نمی باشد
                                        @endif
                                    </div>
                                    {{--<div class="product-icon-left floatleft">--}}
                                        {{--<a href="#" data-toggle="tooltip" title="مقایسه"><i class="fa fa-exchange"></i></a>--}}
                                        {{--<a href="#"><i class="fa fa-heart"></i></a>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    {{ $products->links() }}

@endsection
