@extends('rapiden_layouts.master')
@section('title','Larvel Shopping Cart')

@section('header')
    @include('rapiden_layouts.partials.user_header')
@endsection

@section('mainmenu')
    @include('rapiden_layouts.partials.mainmenu')
@endsection

@section('scripts')
    {!! NoCaptcha::renderJs('fa', false, 'recaptchaCallback') !!}
{{--    {!! NoCaptcha::renderJs() !!}--}}
@endsection

@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-area">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{route('products')}}"><i class="fa fa-home"></i> خانه</a></li>
                <li class="active">ورود</li>
            </ol>
        </div>
    </div>
    <!-- breadcrumb end -->

    <div class="account-area pt-30 log">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-lg-5 col-sm-6">
                    <div class="account-info pb-30">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            <div class="form-fields">
                                {{ csrf_field() }}
                                <h2>ورود</h2>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <p>
                                        <label>
                                            نام کاربری
                                            <span class="required">*</span>
                                        </label>
                                        <input id="email" type="email" class="form-control" name="email"
                                               value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </p>
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <p>
                                        <label>
                                            رمز عبور
                                            <span class="required">*</span>
                                        </label>
                                        <input id="password" type="password" class="form-control" name="password"
                                               required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </p>
                                </div>
                                <div class="form-group ">
                                    <p>
                                        {{--{!! NoCaptcha::display(['data-theme' => 'dark']) !!}--}}
                                        {!! NoCaptcha::display() !!}

                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="form-action">
                                <a class="lost_password" href="{{ route('password.request') }}">رمز عبور خود را
                                    فراموش کرده اید؟
                                </a>
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    به خاطر سپاری
                                </label>
                                <input value="ورود" type="submit">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-6">
                    <div class="account-info pb-30">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            <div class="form-fields">
                                {{ csrf_field() }}
                                <h2>ثبت نام</h2>
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <p>
                                        <label for="name">نام و نام خانوادگی</label>
                                        <input id="name" type="text" class="form-control" name="name"
                                               value="{{ old('name') }}" required autofocus>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </p>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <p>
                                        <label>شماره همراه یا ایمیل <span class="required">*</span></label>

                                        <input id="email" type="text" class="form-control" name="email"
                                               value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                         <strong>نام کاربری تکراری است </strong>
                                    </span>
                                        @endif

                                    </p>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <p>
                                        <label>کلمه عبور <span class="required">*</span></label>

                                        <input id="password" type="password" class="form-control" name="password"
                                               required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </p>
                                </div>

                                <div class="form-group">
                                    <p>
                                        <label>تکرار کلمه عبور<span class="required">*</span></label>
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required>
                                    </p>
                                </div>

                            </div>


                            <div class="form-action floatleft">
                                <div >
                                    <p>
                                        {{--{!! NoCaptcha::display(['data-theme' => 'dark']) !!}--}}
                                        {!! NoCaptcha::display() !!}

                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                        @endif
                                    </p>
                                </div>
                                <input value="ثبت نام" type="submit">

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
