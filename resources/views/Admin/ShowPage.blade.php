@extends('admin.layouts.admin_master')
@section('title','Admic Create Page')
@section('content')
    <div class="col-sm-10 center-block">

            <div>
                <div class="form-group">
                    <h1>{{$f_page->title}}</h1>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        {!! $f_page->body !!}
                    </div>
                </div>
            </div>

    </div>
@endsection

