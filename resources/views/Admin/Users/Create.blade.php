@extends('layouts.admin_master')
@section('title','Admic Create Page')

@section('content')
    <div class="col-sm-10 center-block" style="margin-top: 2%">

        <form action="{{route('users.store')}}" method="POST">
            {{csrf_field()}}
            <div class="panel panel-info">
                <div class="panel-heading">کاربر جدید</div>
                <div class="panel-body">
                    <label for="usr">نام و نام خانوادگی </label>
                    <input type="text" class="form-control" name="name" required>
                    <label for="pwd">پست الکترونیکی </label>
                    <input type="text"  class="form-control" name="email" id="email" required>
                    <label for="pwd">کلمه عبور  </label>
                    <input type="text"  class="form-control" name="password" id="password"  placeholder="Password" value="{{rand(10000,100000)}}" required>
                    <br>
                    <div class="panel panel-info">
                        <div class="panel-heading" >جایگاه</div>
                        <div class="panel-body">
                            @foreach ($roles as $role)
                                <div class="field">
                                    <input type="checkbox" name="Role_select[]" value="{{$role->id}}"> {{$role->display_name}}</input>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" id="add_category">ثبت</button>

                </div>
            </div>

        </form>
    </div>
@endsection

@section('scripts')

@endsection