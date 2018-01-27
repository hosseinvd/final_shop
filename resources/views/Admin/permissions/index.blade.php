@extends('admin.layouts.admin_master')
@section('title','Permissions')
@section('content')
  <div class="col-sm-10 center-block" style="margin-top: 2%">
    <div class="panel">
      <div class="panel-heading">مدیریت کاربران</div>
      <div class="panel-body">
        <a href="{{route('permissions.create')}}" class="btn btn-success pull-left"><i class="fa fa-user-plus "></i> Create New Permission</a>

        <div class="col-md-12" id="user_table">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Name</th>
              <th>Slug</th>
              <th>Description</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($permissions as $permission)
              <tr>
                <th>{{$permission->display_name}}</th>
                <td>{{$permission->name}}</td>
                <td>{{$permission->description}}</td>
                <td class="has-text-right">
                  <a class="button is-outlined m-l-5 btn btn-success" href="{{route('permissions.show', $permission->id)}}">View</a>
                  <a class="button is-light btn btn-warning" href="{{route('permissions.edit', $permission->id)}}">Edit</a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div> <!-- end of .card -->


      </div>
    </div>

  </div>

@endsection

