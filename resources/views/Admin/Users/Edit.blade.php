@extends('admin.layouts.admin_master')
@section('title','Admic Create Page')
@section('styles')
    {{--    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}"  crossorigin="anonymous">--}}
    <link rel="stylesheet" href="{{asset('css/persian-datepicker.css')}}" crossorigin="anonymous">

@endsection
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{route('a_Dashboard')}}"><i class="fa fa-home"></i> داشبورد</a></li>
                <li><a href="{{route('users.index')}}"><i class="fa fa-home"></i> مدیریت کاربران</a></li>
                <li class="active">ویرایش اطلاعات کاربر</li>
            </ol>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 center-block" id="app" style="margin-top: 2%">

        <form action="{{route('users.update',$user->id)}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">اطلاعات</div>
                    <div class="panel-body">
                        <div class="col-md-2">
                            <img src="{{asset('images/profile_img').'/'.$user_info->imagePath}}" alt=""
                                 class="center-block img-circle img-responsive" style="width: 150px">
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <div class="col-md-12">
                            <label for="usr">نام مستعار </label>
                            <input type="text" class="form-control" name="u_name" value="{{$user->name}}" required>
                            <label for="pwd">پست الکترونیکی یا نام کاربری </label>
                            <input type="text" class="form-control" name="u_email" id="u_email" value="{{$user->email}}"
                                   required>
                            </div>
                            <div class="col-md-6">
                                <label for="pwd">کلمه عبور </label>
                                <input type="text" class="form-control" name="u_password" id="u_password"
                                       placeholder="Password"
                                       value="{{rand(10000,100000)}}" required>
                            </div>
                            <br>
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label><input type="checkbox" value="change_pass" name="change_pass">تغییر کلمه
                                        عبور</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">دسترسی ها</div>
                                <div class="panel-body">
                                    <div class="form-group" style="height: 120px; overflow: scroll;overflow: auto;">
                                        @foreach ($roles as $role)
                                                    <div class="field">
                                                        <input type="checkbox" v-model="rolesSelected" name="Role_select[]"
                                                               value="{{$role->id}}"> {{$role->display_name}}</input>
                                                    </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">زیر مجموعه ها</div>

                                <div class="panel-body">
                                    <div class="form-group" style="height: 120px; overflow: scroll;overflow: auto;">
                                        @if(!empty($user_info->resellers))
                                                @foreach($user_info->resellers as $reseller)
                                                <div class="field">
                                                    {{$reseller->family}}
                                                </div>
                                                @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 ">
                            <div class="form-group col-md-4 col-sm-12">

                                    <label for="name">نام  </label>
                                    <input type="text" name="name"  class="form-control" required value="{{$user_info->name}}">

                                <label for="billing_email">آدرس ایمیل<abbr title="required" class="required">*</abbr></label>
                                <input type="text" name="user_email" id="user_email" value="{{$user_info->user_email}}" class="form-control" required>


                                <label for="billing_country">کشور<abbr title="required" class="required">*</abbr></label>
                                <select class="form-control" id="billing_country" name="country">
                                    <option value="">انتخاب کشور</option>
                                    <option value="iran" selected>ایران</option>
                                </select>

                                <label for="billing_address_1">آدرس<abbr title="required" class="required">*</abbr></label>
                                <textarea name="address" class="form-control" id="address" placeholder="آدرس" value="{{$user_info->address}}" class="form-controller" required>{{$user_info->address}}</textarea>

                                <input type="checkbox" value="forever" id="terms" name="terms">
                                <label class="inline" for="terms">اینجانب <a href="#">قوانین و مقررات</a> را خوانده ام و میپذیرم.</label>



                            </div>
                            <div class="form-group col-md-2 col-sm-12">
                                <label for="billing_last_name">نام خانوادگی<abbr title="required" class="required">*</abbr></label>
                                <input type="text" name="family" id="family" class="form-control" value="{{$user_info->family}}" required>

                                <label for="billing_city">تاریخ تولد<abbr title="required" class="required">*</abbr></label>
                                <input type="date" name="birthday" id="start_date" value="{{jdate($user_info->birthday)->format('%d %B، %Y')}}" class="form-control" required>


                                <label for="billing_state">استان<abbr title="required" class="required">*</abbr></label>
                                <input type="text" name="province" id="province" value="{{$user_info->province}}" class="form-control" required>

                                <label for="billing_email">تلفن<abbr title="required" class="required">*</abbr></label>
                                <input type="text" name="phone_number" id="phone_number" value="{{$user_info->phone_number}}" class="form-control" required>


                                     {{--<input type="text" id="pcal1" name="birthday" class="pdate">--}}
                            </div>
                            <div class="form-group col-md-2 col-sm-12">

                                <label for="billing_company">کد ملی <abbr title="required" class="required">*</abbr></label>
                                <input type="number" name="national_code" id="national_code"  value="{{$user_info->national_code}}" class="form-control" required>

                                <label>تصویر</label>
                                <input type="file" class="form-control" name="images" id="images"
                                       placeholder="تصویر " value="" >

                                <label for="billing_city">شهر<abbr title="required" class="required">*</abbr></label>
                                <input type="text" name="city" id="city" value="{{$user_info->city}}" class="form-control" required>

                                <label for="billing_postcode">کدپستی<abbr title="required" class="required">*</abbr></label>
                                    <input type="text" name="postal_code" id="postal_code" value="{{$user_info->postal_code}}" class="form-control" required>

                            </div>

                            <div class="form-group col-md-4 col-sm-12 ">

                                <label for="commision"> سهم سرگروه </label>
                                <input type="text" name="commission" id="commission" value="{{$user_info->commission}}" class="form-control" required>

                                <label for="user_name"> تعیین سر گروه </label>
                                <br>
                                <input type="text" id="user_name"
                                       name="user_name"
                                       class="form-control" value=''
                                       placeholder="{{$user_info->seller->family}}">

                                <div  id="user_table" >
                                    <input hidden type="hidden" class="form-control" id="seller_id" placeholder="seller_id" name="seller_id" value="{{$user_info->seller_id}}">
                                    <h4>سرگروه فعلی :{{$user_info->seller->family}}</h4>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" id="add_category">ثبت تغییرات</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
            <script src="{{asset('js/persian.date.js')}}"></script>
            <script src="{{asset('js/persian.datepicker.0.4.5.js')}}"></script>
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                password_options: 'keep',
                rolesSelected:{!! $user->roles->pluck('id') !!}
            }
        });
        $("#start_date").pDatepicker({
            format : "YYYY-MM-DD",
            autoClose : true,
            toolbox : false
        });

        $("#user_name").keyup(function () {
            var user_name = $("#user_name").val();
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            if(user_name.length>-1){
                $.post("/admin/Update",
                    {
                        user_name: user_name,
                        _token: CSRF_TOKEN,
                        request_name: "seller_sel"
                    },
                    function (data) {
                        $("#user_table").html(data);
                    });
            }
        });

        $("#start_date").pDatepicker("setDate", [1396,01,01]);
    </script>


@endsection