<header>
    <!-- header-top-area-start -->
    <div class="header-top-area black-bg ptb-7">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-4 hidden-xs">
                    <div class="header-top-right">
                        <span><a href="#">تلفن تماس: </a><span class="ltr_text">09132948649</span></span>
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
                            <li class="slide-toggle-3 text-uppercase"><a href="{{route('user-basket')}}"> {{Cart::count()}} آیتم در سبد خرید</a>
                                <ul class="show-toggle-3">
                                    <li>
                                        <a href="{{route('user-basket')}}">
                                            <span class="title-cart">سبد خرید</span>
                                            <span class="count-item">{{Cart::count()}} محصول</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- header-bottom-area-end -->
</header>