@extends('layouts.admin_master')
@section('title','Roles')
@section('content')
    <div class="col-sm-10 center-block">
        <div class="columns m-t-10">
            <div class="column">
                <h1 class="title">Manage Roles</h1>
            </div>
            <div>
                <a href="{{route('roles.create')}}" class="button is-primary is-pulled-right">
                <i class="fa fa-user-plus"></i> Create New Role</a>
            </div>
        </div>
        <div class="col-md-12">
            @foreach ($roles as $role)
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h1 class="panel-title">{{$role->display_name}}</h1>
                        </div>
                        <div class="panel-body">
                            <h3 class="subtitle"><em>{{$role->name}}</em></h3>
                            <p>
                                {{$role->description}}
                            </p>
                        </div>
                        <div class="panel-footer">
                            <a class="button is-light btn btn-warning"
                               href="{{route('roles.show', $role->id)}}">Details</a>
                            <a class="button is-light btn btn-success"
                               href="{{route('roles.edit', $role->id)}}">Edit</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
