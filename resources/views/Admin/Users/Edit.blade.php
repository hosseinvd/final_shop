@extends('layouts.admin_master')
@section('title','Admic Create Page')

@section('content')
    <div class="col-sm-10 center-block" id="app" style="margin-top: 2%">

        <form action="{{route('users.update',$user->id)}}" method="POST">
            {{csrf_field()}}
            {{method_field('PUT')}}

            <div class="panel panel-info">
                <div class="panel-heading">اطلاعات</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="usr">نام و نام خانوادگی </label>
                        <input type="text" class="form-control" name="name" value="{{$user->name}}" required>
                        <label for="pwd">پست الکترونیکی </label>
                        <input type="text" class="form-control" name="email" id="email" value="{{$user->email}}"
                               required>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="pwd">کلمه عبور </label>
                            <input type="text" class="form-control" name="password" id="password" placeholder="Password"
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
                    <div class="form-group">
                            @foreach ($roles as $role)
                                <div class="field">
                                    <input v-model="rolesSelected" type="checkbox" name="Role_select[]"
                                           value="{{$role->id}}"> {{$role->display_name}}</input>
                                </div>
                            @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" id="add_category">ثبت تغییرات</button>

                </div>
            </div>

        </form>
    </div>
@endsection

@section('scripts')
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                password_options: 'keep',
                rolesSelected:{!! $user->roles->pluck('id') !!}
            }
        });
    </script>
@endsection