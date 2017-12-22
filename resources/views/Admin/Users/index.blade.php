@extends('layouts.admin_master')
@section('title','Admic Create Page')
@section('content')
    <div class="col-sm-10 center-block" style="margin-top: 2%">
        <div class="panel">
            <div class="panel-heading">مدیریت کاربران</div>
            <div class="panel-body">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-2">
                            <label> جستجو </label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" id="user_name"
                                   name="user_name"
                                   class="form-control"
                                   placeholder=" نام و یا نام خانوادگی">
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <label class="col-md-3 control-label">جایگاه</label>
                    <div class="col-md-9">
                        <select class="form-control m-bot15"
                                id="R_sel" >
                            <option name="role_id" value="*">----</option>
                            @foreach ($roles as $role)
                                <option name="role_id" value='{{$role->id}}'>{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="{{route('users.create')}}" class="btn btn-success pull-left"><i
                                class="fa fa-user-plus m-l-10"></i> ایجاد کاربر جدید </a>
                </div>
                <div class="col-md-12" id="user_table">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Date Created</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th>{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        <li>
                                            {{$role->name}}
                                        </li>
                                    @endforeach
                                </td>
                                <td>{{$user->created_at->toFormattedDateString()}}</td>
                                <td class="has-text-right">
                                    <a class="button is-outlined m-l-5 btn btn-success" href="{{route('users.show', $user->id)}}">View</a>
                                    <a class="button is-light btn btn-warning" href="{{route('users.edit', $user->id)}}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$users->links()}}
                </div> <!-- end of .card -->


            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        $("#user_name").keyup(function () {
            var user_name = $("#user_name").val();
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            if(user_name.length>-1){
            $.post("/admin/Update",
                {
                    user_name: user_name,
                    _token: CSRF_TOKEN,
                    request_name: "user_name"
                },
                function (data) {
                    $("#user_table").html(data);
                });
            }
        });

        $("#R_sel").change(function () {
            var role_id = $("#R_sel").val();
            CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.post("/admin/Update",
                {
                    role_id: role_id,
                    _token: CSRF_TOKEN,
                    request_name: "role_relect"
                },
                function (data) {
                    $("#user_table").html(data);
                });
        });
    </script>
@endsection