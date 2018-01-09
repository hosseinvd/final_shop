<header>
    <!-- header-top-area-start -->
    <div class="header-top-area black-bg ptb-7">
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
    <div class="header-bottom-area bg-color-1 ptb-25">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="logo">
                        <a href="index.html"><img src="{{asset('img/logo_2.png')}}" alt=""></a>
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

                        <div class="shop-cart-area">
                            <div class="top-cart-wrapper">
                                <div class="block-cart">
                                    <div class="top-cart-title">
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