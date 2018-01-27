@extends('admin.layouts.admin_master')
@section('title','Admic Create Page')
@section('content')
  <div class="flex-container" xmlns="http://www.w3.org/1999/html">
    <div class="container col-md-2 center-block"></div>
    <div class="container col-md-8 center-block">
      <div class="panel panel-group">
        <div class="panel panel-info">
          <div class="panel-heading">Create New Permission</div>
          <div class="panel-body">
            <form action="{{route('permissions.store')}}" method="POST">
              {{csrf_field()}}
            <label for="usr"> نام نمایشی </label>
            <input type="text" class="form-control" name="display_name" id="display_name">
            <label for="usr"> نام اصلی </label>
            <input type="text" class="form-control" name="name" id="name">
            <label for="pwd">توضیحات</label>
            <input type="text" class="form-control" name="description" id="description">
            <br>
            <button class="button is-success">ثبت</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')

@endsection

