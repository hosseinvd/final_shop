@extends('layouts.admin_master')
@section('title','Larvel Shopping Cart')
@section('content')


        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                داشبرد
                <small>ورژن ۲</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li class="active">داشبرد</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">قدرت سرور</span>
                            <span class="info-box-number">90<small>%</small></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">لایک ها</span>
                            <span class="info-box-number">41,410</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">فروش</span>
                            <span class="info-box-number">760</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">کاربران جدید</span>
                            <span class="info-box-number">2,000</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">گزارش ماهانه</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-wrench"></i></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">منوی ۱</a></li>
                                        <li><a href="#">منوی ۲</a></li>
                                        <li><a href="#">منو ۳</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">لینک</a></li>
                                    </ul>
                                </div>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="text-center">
                                        <strong>فروش ۳ مرداد ۱۳۹۶</strong>
                                    </p>

                                    <div class="chart">
                                        <!-- Sales Chart Canvas -->
                                        <canvas id="salesChart" style="height: 180px;"></canvas>
                                    </div>
                                    <!-- /.chart-responsive -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <p class="text-center">
                                        <strong>میزان پیشرفت اهداف</strong>
                                    </p>

                                    <div class="progress-group">
                                        <span class="progress-text">سفارش در ماه</span>
                                        <span class="progress-number"><b>160</b>/200</span>

                                        <div class="progress sm">
                                            <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                                        </div>
                                    </div>
                                    <!-- /.progress-group -->
                                    <div class="progress-group">
                                        <span class="progress-text">محصول</span>
                                        <span class="progress-number"><b>310</b>/400</span>

                                        <div class="progress sm">
                                            <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                                        </div>
                                    </div>
                                    <!-- /.progress-group -->
                                    <div class="progress-group">
                                        <span class="progress-text">مشتری جدید</span>
                                        <span class="progress-number"><b>480</b>/800</span>

                                        <div class="progress sm">
                                            <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                                        </div>
                                    </div>
                                    <!-- /.progress-group -->
                                    <div class="progress-group">
                                        <span class="progress-text">بازدید جدید</span>
                                        <span class="progress-number"><b>250</b>/500</span>

                                        <div class="progress sm">
                                            <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                                        </div>
                                    </div>
                                    <!-- /.progress-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- ./box-body -->
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-3 col-xs-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                                        <h5 class="description-header"> 35,210.43 تومان</h5>
                                        <span class="description-text">کل گردش حساب</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-xs-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                                        <h5 class="description-header">10,390.90 تومان</h5>
                                        <span class="description-text">فروش کل</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-xs-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                                        <h5 class="description-header">24,813.53 تومان</h5>
                                        <span class="description-text">سود کل</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-xs-6">
                                    <div class="description-block">
                                        <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                                        <h5 class="description-header">1200</h5>
                                        <span class="description-text">اهداف</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-8">
                    <!-- MAP & BOX PANE -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">بازدیدها</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="row">
                                <div class="col-md-9 col-sm-8">
                                    <div class="pad">
                                        <!-- Map will be created here -->
                                        <div id="world-map-markers" style="height: 325px;"></div>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3 col-sm-4">
                                    <div class="pad box-pane-right bg-green" style="min-height: 280px">
                                        <div class="description-block margin-bottom">
                                            <div class="sparkbar pad" data-color="#fff">90,70,90,70,75,80,70</div>
                                            <h5 class="description-header">8390</h5>
                                            <span class="description-text">بازدید</span>
                                        </div>
                                        <!-- /.description-block -->
                                        <div class="description-block margin-bottom">
                                            <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                                            <h5 class="description-header">30%</h5>
                                            <span class="description-text">کاربر قدیمی</span>
                                        </div>
                                        <!-- /.description-block -->
                                        <div class="description-block">
                                            <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                                            <h5 class="description-header">70%</h5>
                                            <span class="description-text">کاربر جدید</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- DIRECT CHAT -->
                            <div class="box box-warning direct-chat direct-chat-warning">
                                <div class="box-header with-border">
                                    <h3 class="box-title">پشتیبانی</h3>

                                    <div class="box-tools pull-right">
                                        <span data-toggle="tooltip" title="۳ پیام جدید" class="badge bg-yellow">3</span>
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="کاربران"
                                                data-widget="chat-pane-toggle">
                                            <i class="fa fa-comments"></i></button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <!-- Conversations are loaded here -->
                                    <div class="direct-chat-messages">
                                        <!-- Message. Default to the left -->
                                        <div class="direct-chat-msg">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name pull-right">امین</span>
                                                <span class="direct-chat-timestamp pull-left">۱۲ خرداد ساعت ۱۲:۳۴</span>
                                            </div>
                                            <!-- /.direct-chat-info -->
                                            <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">
                                                سلام این قالب رایگان هست؟
                                            </div>
                                            <!-- /.direct-chat-text -->
                                        </div>
                                        <!-- /.direct-chat-msg -->

                                        <!-- Message to the right -->
                                        <div class="direct-chat-msg right">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name pull-right">سارا</span>
                                                <span class="direct-chat-timestamp pull-left"> خرداد ساعت ۱۲:۴۵</span>
                                            </div>
                                            <!-- /.direct-chat-info -->
                                            <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">
                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">
                                                بله کاملا رایگان هست
                                            </div>
                                            <!-- /.direct-chat-text -->
                                        </div>
                                        <!-- /.direct-chat-msg -->

                                        <!-- Message. Default to the left -->
                                        <div class="direct-chat-msg">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name pull-right">امین</span>
                                                <span class="direct-chat-timestamp pull-left"> خرداد ساعت ۱۳:۳۲</span>
                                            </div>
                                            <!-- /.direct-chat-info -->
                                            <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">
                                                از کجا میتونم دانلود کنم؟
                                            </div>
                                            <!-- /.direct-chat-text -->
                                        </div>
                                        <!-- /.direct-chat-msg -->

                                        <!-- Message to the right -->
                                        <div class="direct-chat-msg right">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name pull-right">سارا</span>
                                                <span class="direct-chat-timestamp pull-left"> خرداد ساعت ۱۳:۴۴</span>
                                            </div>
                                            <!-- /.direct-chat-info -->
                                            <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">
                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">
                                                در منوی بالای صفحه روی دکمه دانلود رایگان قالب کلیک کنید
                                            </div>
                                            <!-- /.direct-chat-text -->
                                        </div>
                                        <!-- /.direct-chat-msg -->

                                    </div>
                                    <!--/.direct-chat-messages-->

                                    <!-- Contacts are loaded here -->
                                    <div class="direct-chat-contacts">
                                        <ul class="contacts-list">
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img" src="dist/img/user1-128x128.jpg" alt="User Image">

                                                    <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  علیرضا
                                  <small class="contacts-list-date pull-left">2/28/2015</small>
                                </span>
                                                        <span class="contacts-list-msg">مدیر کل سایت</span>
                                                    </div>
                                                    <!-- /.contacts-list-info -->
                                                </a>
                                            </li>
                                            <!-- End Contact Item -->
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img" src="dist/img/user7-128x128.jpg" alt="User Image">

                                                    <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  سارا
                                  <small class="contacts-list-date pull-left">2/23/2015</small>
                                </span>
                                                        <span class="contacts-list-msg">ناظر سایت</span>
                                                    </div>
                                                    <!-- /.contacts-list-info -->
                                                </a>
                                            </li>
                                            <!-- End Contact Item -->
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img" src="dist/img/user3-128x128.jpg" alt="User Image">

                                                    <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  نادیا
                                  <small class="contacts-list-date pull-left">2/20/2015</small>
                                </span>
                                                        <span class="contacts-list-msg">پشتیبانی</span>
                                                    </div>
                                                    <!-- /.contacts-list-info -->
                                                </a>
                                            </li>
                                            <!-- End Contact Item -->
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img" src="dist/img/user5-128x128.jpg" alt="User Image">

                                                    <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  نورا
                                  <small class="contacts-list-date pull-left">2/10/2015</small>
                                </span>
                                                        <span class="contacts-list-msg">پشتیبانی</span>
                                                    </div>
                                                    <!-- /.contacts-list-info -->
                                                </a>
                                            </li>
                                            <!-- End Contact Item -->
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img" src="dist/img/user6-128x128.jpg" alt="User Image">

                                                    <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  محمد
                                  <small class="contacts-list-date pull-left">1/27/2015</small>
                                </span>
                                                        <span class="contacts-list-msg">مدیر فنی</span>
                                                    </div>
                                                    <!-- /.contacts-list-info -->
                                                </a>
                                            </li>
                                            <!-- End Contact Item -->
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img" src="dist/img/user8-128x128.jpg" alt="User Image">

                                                    <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  نگین
                                  <small class="contacts-list-date pull-left">1/4/2015</small>
                                </span>
                                                        <span class="contacts-list-msg">گرافیست</span>
                                                    </div>
                                                    <!-- /.contacts-list-info -->
                                                </a>
                                            </li>
                                            <!-- End Contact Item -->
                                        </ul>
                                        <!-- /.contatcts-list -->
                                    </div>
                                    <!-- /.direct-chat-pane -->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <form action="#" method="post">
                                        <div class="input-group">
                                            <input type="text" name="message" placeholder="پیام..." class="form-control">
                                            <span class="input-group-btn">
                            <button type="button" class="btn btn-warning btn-flat">ارسال</button>
                          </span>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.box-footer-->
                            </div>
                            <!--/.direct-chat -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-6">
                            <!-- USERS LIST -->
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h3 class="box-title">آخرین کاربران</h3>

                                    <div class="box-tools pull-right">
                                        <span class="label label-danger">۸ کاربر جدید</span>
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <ul class="users-list clearfix">
                                        <li>
                                            <img src="dist/img/user1-128x128.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">الکساندر گراهامبل</a>
                                            <span class="users-list-date">امروز</span>
                                        </li>
                                        <li>
                                            <img src="dist/img/user8-128x128.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">نیوتن</a>
                                            <span class="users-list-date">دیروز</span>
                                        </li>
                                        <li>
                                            <img src="dist/img/user7-128x128.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">جودی ابوت</a>
                                            <span class="users-list-date">۱۴ شهریور</span>
                                        </li>
                                        <li>
                                            <img src="dist/img/user6-128x128.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">اوباما</a>
                                            <span class="users-list-date">۱۵ شهریور</span>
                                        </li>
                                        <li>
                                            <img src="dist/img/user2-160x160.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">استیو جابز</a>
                                            <span class="users-list-date">۳۰ شهریور</span>
                                        </li>
                                        <li>
                                            <img src="dist/img/user5-128x128.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">ادیسون</a>
                                            <span class="users-list-date">۲ هفته پیش</span>
                                        </li>
                                        <li>
                                            <img src="dist/img/user4-128x128.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">شنل قرمزی</a>
                                            <span class="users-list-date">۲ ماه پیش</span>
                                        </li>
                                        <li>
                                            <img src="dist/img/user3-128x128.jpg" alt="User Image">
                                            <a class="users-list-name" href="#">سرندیپیتی</a>
                                            <span class="users-list-date">۳ سال پیش</span>
                                        </li>
                                    </ul>
                                    <!-- /.users-list -->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer text-center">
                                    <a href="javascript:void(0)" class="uppercase">نمایش همه کاربران</a>
                                </div>
                                <!-- /.box-footer -->
                            </div>
                            <!--/.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">آخرین سفارشات</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>شماره</th>
                                        <th>محصول</th>
                                        <th>وضعیت</th>
                                        <th>رضایت مشتری</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                        <td>آیفون ۵</td>
                                        <td><span class="label label-success">ارسال شده</span></td>
                                        <td>
                                            <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                        <td>سامسونگ ۶</td>
                                        <td><span class="label label-warning">در انتظار</span></td>
                                        <td>
                                            <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                        <td>آیفون ۶</td>
                                        <td><span class="label label-danger">پرداخت شده</span></td>
                                        <td>
                                            <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                        <td>لپ تاپ ایسوز</td>
                                        <td><span class="label label-info">در حال پردازش</span></td>
                                        <td>
                                            <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                        <td>مک بوک ایر</td>
                                        <td><span class="label label-warning">در انتظار</span></td>
                                        <td>
                                            <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                        <td>سونی اکسپریا</td>
                                        <td><span class="label label-danger">پرداخت شده</span></td>
                                        <td>
                                            <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                        <td>ماوس اپتیکال</td>
                                        <td><span class="label label-success">ارسال شده</span></td>
                                        <td>
                                            <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">سفارش جدید</a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">نمایش همه</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->

                <div class="col-md-4">
                    <!-- Info Boxes Style 2 -->
                    <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">فهرست</span>
                            <span class="info-box-number">5,200</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 50%"></div>
                            </div>
                            <span class="progress-description">
                    ۵۰ درصد افزایش در ۳۰ روز گذشته
                  </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">برگزیده ها</span>
                            <span class="info-box-number">92,050</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 20%"></div>
                            </div>
                            <span class="progress-description">
                      ۲۰ درصد افزایش در ۳۰ روز گذشته
                  </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">دانلود</span>
                            <span class="info-box-number">114,381</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 70%"></div>
                            </div>
                            <span class="progress-description">
                      ۷۰ درصد افزایش در ۳۰ روز گذشته
                  </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">پیام های پشتیبانی</span>
                            <span class="info-box-number">163,921</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 40%"></div>
                            </div>
                            <span class="progress-description">
                      ۴۰ درصد کاهش در ۳۰ روز گذشته
                  </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->

                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">مرورگرها</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="chart-responsive">
                                        <canvas id="pieChart" height="150"></canvas>
                                    </div>
                                    <!-- ./chart-responsive -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <ul class="chart-legend clearfix">
                                        <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
                                        <li><i class="fa fa-circle-o text-green"></i> IE</li>
                                        <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
                                        <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
                                        <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
                                        <li><i class="fa fa-circle-o text-gray"></i> دیگر</li>
                                    </ul>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">ایران
                                        <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
                                <li><a href="#">آمریکا <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>
                                </li>
                                <li><a href="#">انگلستان
                                        <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
                            </ul>
                        </div>
                        <!-- /.footer -->
                    </div>
                    <!-- /.box -->

                    <!-- PRODUCT LIST -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">آخرین محصولات</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <ul class="products-list product-list-in-box">
                                <li class="item">
                                    <div class="product-img">
                                        <img src="dist/img/default-50x50.gif" alt="Product Image">
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title">آیفون ۵ اس
                                            <span class="label label-warning pull-left">$1800</span></a>
                                        <span class="product-description">
                          گوشی اپل
                        </span>
                                    </div>
                                </li>
                                <!-- /.item -->
                                <li class="item">
                                    <div class="product-img">
                                        <img src="dist/img/default-50x50.gif" alt="Product Image">
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title">دوچرخه کوهستان
                                            <span class="label label-info pull-left">$700</span></a>
                                        <span class="product-description">
                          دوچرخه حرفه ای و زیبا
                        </span>
                                    </div>
                                </li>
                                <!-- /.item -->
                                <li class="item">
                                    <div class="product-img">
                                        <img src="dist/img/default-50x50.gif" alt="Product Image">
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title">کنسول مایکروسافت <span
                                                    class="label label-danger pull-left">$350</span></a>
                                        <span class="product-description">
                          کنسول بازی حرفه ای و قوی
                        </span>
                                    </div>
                                </li>
                                <!-- /.item -->
                                <li class="item">
                                    <div class="product-img">
                                        <img src="dist/img/default-50x50.gif" alt="Product Image">
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title">لپ تاپ ایسر
                                            <span class="label label-success pull-left">$399</span></a>
                                        <span class="product-description">
                          لپ تاپ اقتصادی
                        </span>
                                    </div>
                                </li>
                                <!-- /.item -->
                            </ul>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <a href="javascript:void(0)" class="uppercase">نمایش همه</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>



@endsection