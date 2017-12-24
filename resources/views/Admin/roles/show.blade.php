@extends('layouts.admin_master')
@section('title','Roles')
@section('content')
  <div class="flex-container" xmlns="http://www.w3.org/1999/html">
    <div class="container col-md-2 center-block"></div>
    <div class="container col-md-8 center-block">
      <div class="panel panel-group">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h1 class="title">{{$role->display_name}}<small><em>({{$role->name}})</em></small></h1>
            <h5>{{$role->description}}</h5>
          </div>
          <div class="panel-body">
            <div class="column">
              <a href="{{route('roles.edit', $role->id)}}" class="button is-light btn btn-success pull-left"><i class="fa fa-user-plus m-r-10"></i> Edit this Role</a>
            </div>
            <div class="content">
              <h1 class="title">Permissions:</h1>
              <ul>
                @foreach ($role->permissions as $r)
                  <li>{{$r->display_name}} <em class="m-l-15">({{$r->description}})</em></li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
