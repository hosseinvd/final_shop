@extends('layouts.admin_master')
@section('title','Admic Create Page')
@section('content')
  <div class="flex-container" xmlns="http://www.w3.org/1999/html">
    <div class="container col-md-2 center-block"></div>
    <div class="container col-md-8 center-block">
      <div class="panel panel-group">
        <div class="panel panel-info">
          <div class="panel-heading">Edit Permission</div>
          <div class="panel-body">
            <form action="{{route('permissions.update', $permission->id)}}" method="POST">
              {{csrf_field()}}
              {{method_field('PUT')}}
              <label for="usr"> نام نمایشی </label>
              <input type="text" class="form-control" name="display_name" id="display_name" value="{{$permission->display_name}}">
              <label for="usr"> نام اصلی </label>
              <input type="text" class="form-control" name="name" id="name" value="{{$permission->name}}" disabled>
              <label> توضیحات</label>
              <input type="text" class="form-control" name="description" id="description" value="{{$permission->description}}">
              <br>
              <button class="button is-success">ثبت</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
