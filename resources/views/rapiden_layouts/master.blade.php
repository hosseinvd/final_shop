<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/png" href="img/favicon.png">

    <!-- all css here -->
    <!-- bootstrap.min.css -->

    <link rel="stylesheet" href="{{asset('css/rapiden.css')}}">
    <link rel="stylesheet" href="{{asset('css/rapiden_mystyle.css')}}">
    @yield('styles')

    <script src="{{asset('rapiden_js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>
<body>
<!--[if lt IE 9]>
<p class="browserupgrade">شما از یک مرورگر <strong>قدیمی</strong> استفاده می کنید. لطفا مرورگر خود را <a href="http://browsehappy.com/">به روز</a> نمایید تا محتوا را به درستی مشاهده کنید.</p>
<![endif]-->

<!-- header -->
@yield('header')

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
    @yield('slider-area')
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
                                <a href="#"><img src="{{asset('img/footer/1.jpg')}}" alt=""></a>
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

<script src="{{asset('rapiden_js/vendor/jquery-1.12.0.min.js')}}"></script>
<!-- bootstrap.min.js -->
<script src="{{asset('rapiden_js/bootstrap.min.js')}}"></script>
<!-- nivo.slider.js -->
<script src="{{asset('rapiden_js/jquery.nivo.slider.pack.js')}}"></script>
<!-- jquery-ui.min.js -->
<script src="{{asset('rapiden_js/jquery-ui.min.js')}}"></script>
<!-- jquery.magnific-popup.min.js -->
<script src="{{asset('rapiden_js/jquery.magnific-popup.min.js')}}"></script>
<!-- jquery.meanmenu.min.js -->
<script src="{{asset('rapiden_js/jquery.meanmenu.js')}}"></script>
<!-- jquery.scrollup.min.js-->
<script src="{{asset('rapiden_js/jquery.scrollup.min.js')}}"></script>
<!-- owl.carousel.min.js -->
<script src="{{asset('rapiden_js/owl.carousel.min.js')}}"></script>
<!-- plugins.js -->
<script src="{{asset('rapiden_js/plugins.js')}}"></script>
<!-- main.js -->
<script src="{{asset('rapiden_js/main.js')}}"></script>
<!--[if lt IE 10]>
<script src="{{asset('rapiden_js/jquery.placeholder.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">$('input, textarea').placeholder();</script>
<![endif]-->
</body>

@yield('scripts')

</html>
