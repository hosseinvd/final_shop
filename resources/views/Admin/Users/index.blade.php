@extends('layouts.admin_master')
@section('title','Admic Create Page')
@section('content')
    <div class="col-sm-10 center-block" style="margin-top: 2%">
        <row>
            <label class="control-label col-sm-4" for="title">مدیریت کاربران </label>
            <div class="column col-sm-7" >
                <a href="{{route('users.create')}}" class="btn btn-success pull-left"><i class="fa fa-user-plus m-l-10"></i> ایجاد کاربر جدید </a>
            </div>
        </row>
        <hr class="m-t-0">

        <div class="card">
            <div class="card-content">
                <table class="table is-narrow">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Email</th>
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
                            <td>{{$user->created_at->toFormattedDateString()}}</td>
                            <td class="has-text-right"><a class="button is-outlined m-l-5 btn btn-success" href="{{route('users.show', $user->id)}}">View</a> <a class="button is-light btn btn-warning" href="{{route('users.edit', $user->id)}}">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div> <!-- end of .card -->

        {{$users->links()}}
    </div>
@endsection