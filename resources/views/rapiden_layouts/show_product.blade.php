@extends('rapiden_layouts.master')
@section('title','details')

@section('header')
    @include('rapiden_layouts.partials.user_header')
@endsection

@section('mainmenu')
    @include('rapiden_layouts.partials.mainmenu')
@endsection

@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{route('products')}}"><i class="fa fa-home"></i> خانه</a></li>
                <li class="active">جزئیات محصول</li>
            </ol>
        </div>
    </div>
    <!-- breadcrumb end -->
    <!-- product-details-start -->
    <div class="product-details-area">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-5">
                    <div class="product-zoom dotted-style-1">
                        <!-- Tab panes -->
                        <div class="tab-content">

                            @foreach($product->images as $index=>$image)
                                @if($index==0)
                                    <div class="tab-pane active" id="home_product">
                                        <div class="pro-large-img">
                                            <img src="{{asset('product_image').'/'.$image->imagePath}}" alt="">
                                            <a class="popup-link" href="{{asset('product_image').'/'.$product->images()->first()->imagePath}}">مشاهده بزرگتر <i class="fa fa-search-plus" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                @else
                                    <div class="tab-pane" id="profile_{{$index}}">
                                        <div class="pro-large-img">
                                            <img src="{{asset('product_image').'/'.$image->imagePath}}" alt="...">
                                            <a class="popup-link" href="{{asset('product_image').'/'.$image->imagePath}}">مشاهده بزرگتر <i class="fa fa-search-plus" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                        <!-- Nav tabs -->
                        <ul class="details-tab owl-carousel">
                            @foreach($product->images as $index=>$image)
                                @if($index==0)
                                      <li class="active">
                                          <a href="#home_product" data-toggle="tab"><img src="{{asset('product_image').'/'.$image->imagePath}}" alt=""></a>
                                          <a class="popup-link" href="{{asset('product_image').'/'.$image->imagePath}}"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                                      </li>
                                @else
                                      <li>
                                          <a href="#profile_{{$index}}" data-toggle="tab"><img src="{{asset('product_image').'/'.$image->imagePath}}" alt=""></a>
                                          <a class="popup-link" href="{{asset('product_image').'/'.$image->imagePath}}"><i class="fa fa-search-plus" aria-hidden="true"></i></a>

                                      </li>

                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-7">
                    <div class="product-details">
                        <h2 class="pro-d-title">{{$product->title}}</h2>
                        <div class="pro-ref">
                            <p>
                                <label>فروشنده: </label>
                                <span> شرکت سیب پردازان </span>
                            </p>
                            <p>
                                <label>وضعیت: </label>
                                <span>موجود</span>
                            </p>
                        </div>
                        <div class="price-box">
                            <span class="old-price product-price"><del>{{$product->price}}</del></span>
                            <span class="price product-price">{{$product->price-$product->discount}} <small>تومان</small></span>
                        </div>
                        <div class="short-desc">
                            <p>{{$product->description}}</p>
                        </div>

                        <div class="box-quantity">
                            <form class="form-horizontal" method="post" action="{{route('addToCart_with_number')}}" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input class="form-control"  type="hidden" name="id"
                                       value="{{$product->id}}">
                                <label>تعداد</label>
                                <input type="number" name="qty" value="1" min="1">
                                <button type="submit">افزودن به سبد</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product-details-end -->
    <!-- pro-info-area start -->
    <div class="pro-info-area">
        <div class="container">
            <div class="pro-info-box">
                <!-- Nav tabs -->
                <ul class="pro-info-tab" role="tablist">
                    <li class="active"><a href="#home3" data-toggle="tab">اطلاعات بیشتر</a></li>
                    <li><a href="#profile3" data-toggle="tab">مشخصات فنی</a></li>
                    <li><a href="#messages3" data-toggle="tab">نقد و بررسی ها</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="home3">
                        <div class="pro-desc">
                            <p>{!!$product->long_description!!}</p>
                        </div>
                    </div>
                    <div class="tab-pane" id="profile3">
                        <div class="pro-desc">
                            <table class="table-data-sheet">
                                <tbody>
                                <tr class="odd">
                                    <td>جنس</td>
                                    <td>پشم</td>
                                </tr>
                                <tr class="even">
                                    <td>سبک ها</td>
                                    <td>روزانه</td>
                                </tr>
                                <tr class="odd">
                                    <td>خواص</td>
                                    <td>آستین کوتاه</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @include('rapiden_layouts.partials.comment' , ['comments' => $comments , 'subject' => $product])

                </div>
            </div>
        </div>
    </div>
    <!-- pro-info-area end -->
    <!-- .slider-product-area-3-start -->



 @endsection



