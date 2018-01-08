<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/png" href="img/favicon.png">

    <!-- all css here -->
    <!-- bootstrap.min.css -->
    <link rel="stylesheet" href="css/rapiden.css">
    <link rel="stylesheet" href="css/rapiden_mystyle.css">
    @yield('styles')

    <script src="rapiden_js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
<!--[if lt IE 9]>
<p class="browserupgrade">شما از یک مرورگر <strong>قدیمی</strong> استفاده می کنید. لطفا مرورگر خود را <a href="http://browsehappy.com/">به روز</a> نمایید تا محتوا را به درستی مشاهده کنید.</p>
<![endif]-->

<!-- header -->
<header>
    <!-- header-top-area-start -->
    <div class="header-top-area header-area-4 ptb-7">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-4 hidden-xs">
                    <div class="header-top-right">
                        <span><a href="#">تلفن تماس: </a><span class="ltr_text">(+1)866-550-3669</span></span>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8">
                    <div class="header-top-left">
                        <ul>
                                    @guest
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-2x" aria-hidden="true" ></i>  Guest <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a  data-toggle="modal" href="#myModal">Login</a></li>
                                                <li><a href="{{route('register')}}">register</a></li>
                                            </ul>
                                        </li>
                                        @else
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-2x" aria-hidden="true" ></i> {{ Auth::user()->name }}  <span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                    @role('superadministrator|administrator')
                                                    <li><a  href="{{route("a_Dashboard")}}">Admin Panel</a></li>
                                                    @endrole
                                                    <li><a  href="{{route("u_user-profile")}}">User Profile</a></li>
                                                    <li>
                                                        <a href="{{ route('logout') }}"
                                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                            Logout
                                                        </a>

                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                              style="display: none;">
                                                            {{ csrf_field() }}
                                                        </form>
                                                    </li>
                                                </ul>
                                            </li>
                                            @endguest

                        </ul>
                        <ul>
                            <li class="slide-toggle-2 text-uppercase"><a href="#"><i class="fa fa-money"></i>ریال</a>
                                <ul class="show-toggle-2">
                                    <li><a href="#"><i class="fa fa-eur"></i> یورو</a></li>
                                    <li><a href="#"><i class="fa fa-gbp"></i> بیت کوین</a></li>
                                    <li><a href="#"><i class="fa fa-usd"></i> دلار</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul>
                            <li class="slide-toggle-3 text-uppercase"><a href="#">فارسی</a>
                                <ul class="show-toggle-3">
                                    <li><a href="#">انگلیسی</a></li>
                                    <li><a href="#">فارسی</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header-top-area-end -->
    <!-- header-bottom-area-start -->
    <div class="header-bottom-area header-bottom-area-2 pb-40 pt-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="logo">
                        <a href="index.html"><img src="img/logo_2.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="header-bottom-middle">

                        <div class="search-box">
                            <form action="#">
                                <select name="#" id="select">
                                    <option value="">همه دسته ها</option>
                                    <option value="40">لوازم جانبی</option>
                                </select>
                                <input type="text" placeholder="جستجو...">
                                <button><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="header-bottom-left">
                        <div class="left-cart">
                            <div class="header-compire">
                                <a href="#"><i class="fa fa-heart"></i> علاقه‌مندی‌ها 0 </a>
                                <a href="#"><i class="fa fa-refresh"></i> مقایسه 0 </a>
                            </div>
                        </div>

                        <div class="shop-cart-area shop-cart-area-2">
                            <div class="top-cart-wrapper">
                                <div class="block-cart">
                                    <div class="top-cart-title top-cart-title-2">
                                        <a href="{{route('user-basket')}}">
                                            <span class="title-cart">سبد خرید</span>
                                            <span class="count-item">{{Cart::count()}} محصول</span>
                                        </a>
                                    </div>

                                    <div class="top-cart-content">
                                        <ol class="mini-products-list">
                                        @foreach(Cart::content() as $row)

                                            <li>
                                                <a class="product-image" href="{{route('show_product',$row->id)}}">
                                                    <img   alt="" src="{{asset('product_image').'/'.\App\Product::find($row->id)->images()->first()->imagePath}}">
                                                </a>
                                                <div class="product-details">
                                                    <p class="cartproduct-name">
                                                        <a href="product-details.html">{{$row->name}} </a>
                                                    </p>
                                                    <strong class="qty">تعداد: {{$row->qty}}</strong>
                                                    <span class="sig-price">{{$row->price}} <small>تومان</small></span>
                                                </div>
                                                <div class="pro-action">
                                                    <a class="btn-remove" href="#">حذف</a>
                                                </div>
                                            </li>

                                        @endforeach
                                        </ol>
                                        <div class="top-subtotal">
                                            جمع: <span class="sig-price">{{Cart::total()}} <small>تومان</small></span>
                                        </div>
                                        <div class="cart-actions">
                                            <span><a  href="{{route('user-basket')}}">پرداخت <i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i></a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- header-bottom-area-end -->
</header>
<!-- header -->
<!-- mainmenu-area-start -->
<div class="mainmenu-area mainmenu-area-4 bg-color-4 hidden-xs hidden-sm">
    <div class="container">
        <div class="row">
            @yield('category_sidebar')
            @yield('mainmenu')
            {{--@include('rapiden_layouts.partials.category_sidebar')--}}
            {{--@include('rapiden_layouts.partials.mainmenu')--}}
        </div>
    </div>
</div>
<!-- slider-area-start -->
<div class="slider-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 hidden-sm hidden-xs"></div>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="main-slider">
                    <div class="slider-container">
                        <!-- Slider Image -->
                        <div id="mainSlider" class="nivoSlider slider-image">
                            <img src="img/slider/3.jpg" alt="" title="#htmlcaption1">
                            <img src="img/slider/4.jpg" alt="" title="#htmlcaption2">
                        </div>
                    </div>
                </div>
                <div class="slider-product res2 dotted-style-1 pt-20">
                    <div class="slider-product-active-2 owl-carousel">
                        <div class="single-product single-product-sidebar white-bg">
                            <div class="product-img product-img-left">
                                <a href="#"><img src="img/product/6.jpg" alt=""></a>
                            </div>
                            <div class="product-content product-content-right">
                                <div class="pro-title">
                                    <h4><a href="product-details.html">صندلی سالن</a></h4>
                                </div>
                                <div class="pro-rating ">
                                    <a href="#"><i class="fa fa-star"></i></a>
                                </div>
                                <div class="price-box">
                                    <span class="price product-price">440,000 <small>تومان</small></span>
                                </div>
                                <div class="product-icon">
                                    <div class="product-icon-right f-right">
                                        <a href="#"><i class="fa fa-shopping-cart"></i>افزودن به سبد</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-product single-product-sidebar white-bg">
                            <div class="product-img product-img-left">
                                <a href="#"><img src="img/product/9.jpg" alt=""></a>
                            </div>
                            <div class="product-content product-content-right">
                                <div class="pro-title">
                                    <h4><a href="product-details.html">iMac</a></h4>
                                </div>
                                <div class="pro-rating ">
                                    <a href="#"><i class="fa fa-star"></i></a>
                                </div>
                                <div class="price-box">
                                    <span class="price product-price">300,000 <small>تومان</small></span>
                                </div>
                                <div class="product-icon">
                                    <div class="product-icon-right f-right">
                                        <a href="#"><i class="fa fa-shopping-cart"></i>افزودن به سبد</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-product single-product-sidebar white-bg">
                            <div class="product-img product-img-left">
                                <a href="#"><img src="img/product/11.jpg" alt=""></a>
                            </div>
                            <div class="product-content product-content-right">
                                <div class="pro-title">
                                    <h4><a href="product-details.html">iMac</a></h4>
                                </div>
                                <div class="pro-rating ">
                                    <a href="#"><i class="fa fa-star"></i></a>
                                </div>
                                <div class="price-box">
                                    <span class="price product-price">331,000 <small>تومان</small></span>
                                </div>
                                <div class="product-icon">
                                    <div class="product-icon-right f-right">
                                        <a href="#"><i class="fa fa-shopping-cart"></i>افزودن به سبد</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider-area-end -->
<!-- newletter-area-end -->
<!-- all-product-area-start -->
<div class="all-product-area pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        @yield('content')
            </div>
        </div>
    </div>
</div>
<!-- all-product-area-end -->
<footer>
    <!-- footer-top-area -->
    <div class="footer-top-area border-1 ptb-30 bg-color-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="footer-title">
                        <h4>اطلاعات فروشگاه</h4>
                    </div>
                    <div class="footer-widget">
                        <div class="contact-info">
                            <ul>
                                <li>
                                    <div class="contact-icon">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <div class="contact-text">
                                        <span class="address">تبریز، ولیعصر، جنب بانک صادرات، پلاک 67، طبقه 135</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="contact-icon">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                    <div class="contact-text">
                                        <a href="#"><span>info@sample.com</span></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="contact-icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="contact-text">
                                        <span class="ltr_text">(+1)866-550-3669</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="footer-title">
                        <h4>اطلاعات</h4>
                    </div>
                    <div class="footer-widget">
                        <div class="list-unstyled">
                            <ul>
                                <li><a href="#">درباره ما</a></li>
                                <li><a href="#">نحوه ارسال</a></li>
                                <li><a href="#">حریم شخصی</a></li>
                                <li><a href="#">قوانین و مقررات</a></li>
                                <li><a href="#">تماس با ما</a></li>
                                <li><a href="#">نقشه سایت</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="footer-title">
                        <h4>حساب کاربری</h4>
                    </div>
                    <div class="footer-widget">
                        <div class="list-unstyled">
                            <ul>
                                <li><a href="#">حساب کاربری</a></li>
                                <li><a href="#">سابقه خرید</a></li>
                                <li><a href="#">علاقه‌مندی‌ها</a></li>
                                <li><a href="#">خبرنامه</a></li>
                                <li><a href="#">محصولات ویژه</a></li>
                                <li><a href="#">برند ها</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="footer-title">
                        <h4>اینستاگرام</h4>
                    </div>
                    <div class="footer-widget">
                        <div class="footer-widget-img">
                            <div class="single-img">
                                <a href="#"><img src="img/footer/1.jpg" alt=""></a>
                            </div>
                            <div class="single-img">
                                <a href="#"><img src="img/footer/2.jpg" alt=""></a>
                            </div>
                            <div class="single-img">
                                <a href="#"><img src="img/footer/3.jpg" alt=""></a>
                            </div>
                            <div class="single-img">
                                <a href="#"><img src="img/footer/4.jpg" alt=""></a>
                            </div>
                            <div class="single-img">
                                <a href="#"><img src="img/footer/5.jpg" alt=""></a>
                            </div>
                            <div class="single-img">
                                <a href="#"><img src="img/footer/6.jpg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="color:red;"><span class="glyphicon glyphicon-lock"></span> Login</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">نام کاربری </label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">کلمه عبور</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- all js here -->
<!-- jquery-1.12.0 -->
<script src="rapiden_js/vendor/jquery-1.12.0.min.js"></script>
<!-- bootstrap.min.js -->
<script src="rapiden_js/bootstrap.min.js"></script>
<!-- nivo.slider.js -->
<script src="rapiden_js/jquery.nivo.slider.pack.js"></script>
<!-- jquery-ui.min.js -->
<script src="rapiden_js/jquery-ui.min.js"></script>
<!-- jquery.magnific-popup.min.js -->
<script src="rapiden_js/jquery.magnific-popup.min.js"></script>
<!-- jquery.meanmenu.min.js -->
<script src="rapiden_js/jquery.meanmenu.js"></script>
<!-- jquery.scrollup.min.js-->
<script src="rapiden_js/jquery.scrollup.min.js"></script>
<!-- owl.carousel.min.js -->
<script src="rapiden_js/owl.carousel.min.js"></script>
<!-- plugins.js -->
<script src="rapiden_js/plugins.js"></script>
<!-- main.js -->
<script src="rapiden_js/main.js"></script>
<!--[if lt IE 10]>
<script src="rapiden_js/jquery.placeholder.min.js" type="text/javascript"></script>
<script type="text/javascript">$('input, textarea').placeholder();</script>
<![endif]-->
</body>

@yield('scripts')

</html>
