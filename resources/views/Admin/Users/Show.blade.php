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

        </div>
    </div>
    </div>

@endsection