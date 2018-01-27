@extends('admin.layouts.admin_master')
@section('title','Roles')
@section('content')
  <div class="flex-container" xmlns="http://www.w3.org/1999/html">
    <div class="container col-md-2 center-block"></div>
    <div class="container col-md-8 center-block" >
      <div class="panel panel-group">
        <div class="panel panel-info">
          <div class="panel-heading"><h1>Edit {{$role->display_name}}</h1></div>
          <div class="panel-body">
            <form action="{{route('roles.update', $role->id)}}" method="POST">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <label for="usr"> نام نمایشی </label>
              <input type="text" class="form-control" name="display_name" id="display_name" value="{{$role->display_name}}">
              <label for="usr"> نام اصلی </label>
              <input type="text" class="form-control" name="name" id="name" value="{{$role->name}}" disabled>
              <label> توضیحات</label>
              <input type="text" class="form-control" name="description" id="description" value="{{$role->description}}">
<br>
              <div class="panel panel-danger" id="app">
                <div class="panel-heading"> سطوح دسترسی</div>
                <div class="panel-body">
                  @foreach ($permissions as $permission)
                    <div class="field">
                      <input type="checkbox" v-model="permissions_selected" name="permissions_select[]" value="{{$permission->id}}">{{$permission->display_name}} </input>
                    </div>
                  @endforeach
                </div>
                <div class="panel-footer">
                  <button class="button is-success">ثبت</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                password_options: 'keep',
                permissions_selected:{!! $role->permissions->pluck('id') !!}
            }
        });
    </script>
@endsection
