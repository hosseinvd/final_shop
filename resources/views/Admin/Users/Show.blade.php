@extends('admin.layouts.admin_master')
@section('title','users')
@section('content')
    <div class="col-sm-10 center-block" style="margin-top: 2%">
    <div class="panel panel-info">
        <div class="panel-heading">کاربر جدید</div>
        <div class="panel-body">
            <label for="usr">نام و نام خانوادگی </label>
            <pre>{{$user->name}}</pre>
            <label for="pwd">پست الکترونیکی </label>
            <pre>{{$user->email}}</pre>
            <br>
            <div class="panel panel-info">
                <div class="panel-heading" >جایگاه</div>
                <div class="panel-body">
                    @forelse ($user->roles as $role)
                        <li>{{$role->display_name}} ({{$role->description}})</li>
                    @empty
                        <p>This user has not been assigned any roles yet</p>
                    @endforelse

                </div>

            </div>
            <div class="panel panel-info">
                <div class="col-xs-12 col-sm-4 text-center">
                    @if(($user->info_user->national_code!=1))
                        <img src="{{asset('images/profile_img').'/'.$user->info_user->imagePath}}" alt=""
                             class="center-block img-circle img-responsive">
                        <ul class="list-inline ratings text-center" title="Ratings">
                            <li><a href="#"><span class="fa fa-star fa-lg"></span></a></li>
                            <li><a href="#"><span class="fa fa-star fa-lg"></span></a></li>
                            <li><a href="#"><span class="fa fa-star fa-lg"></span></a></li>
                            <li><a href="#"><span class="fa fa-star fa-lg"></span></a></li>

                        </ul>
                    @endif
                </div><!--/col-->
                <div class="col-xs-12 col-sm-8">
                    <h2>{{$user->info_user->name.' '.$user->info_user->family }}</h2>
                    <p><strong>کد ملی :</strong> {{$user->info_user->national_code}} </p>
                    <p><strong>آدرس :</strong> {{$user->info_user->address}} </p>
                    <p><strong>کدپستی :</strong> {{$user->info_user->postal_code}} </p>
                    <p><strong>پست الکترونیکی :</strong> {{$user->info_user->user_email}} </p>
                    <p><strong>نوع کاربر </strong>
                        <span class="label label-success">General User</span>
                    </p>
                </div><!--/col-->
            </div><!--/row-->
        </div>
    </div>
    </div>

@endsection