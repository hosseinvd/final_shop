@extends('layouts.admin_master')
@section('title','Roles')
@section('content')

    <div class="flex-container" xmlns="http://www.w3.org/1999/html">
        <div class="container col-md-2 center-block"></div>
        <div class="container col-md-8 center-block">
            <div class="panel panel-group">
                <div class="panel panel-info">
                    <div class="panel-heading">Create New Role</div>
                    <div class="panel-body">
                        <form action="{{route('roles.store')}}" method="POST">
                            {{csrf_field()}}
                            <label for="display_name" >Name (Human Readable)</label>
                            <input type="text" class="form-control" name="display_name" value="{{old('display_name')}}"
                                   id="display_name">
                            <label for="name" >Slug (Can not be changed)</label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}" id="name">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" value="{{old('description')}}" id="description"
                                   name="description">
                            <br>
                            <button class="button is-success">ثبت</button>

                            <div class="panel panel-info">
                                <div class="panel-heading">Permission</div>
                                <div class="checkbox-group">
                                    @foreach ($permissions as $permission)
                                        <div class="field">
                                            <input type="checkbox" v-model="permissionsSelected"
                                                   value="{{$permission->id}}">{{$permission->display_name}}
                                            <em>({{$permission->description}})</em></input>
                                        </div>
                                    @endforeach
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
                permissionsSelected: []
            }
        });

    </script>
@endsection
