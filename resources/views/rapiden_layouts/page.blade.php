@extends('rapiden_layouts.master')
@section('title','details')

@section('header')
    @include('rapiden_layouts.partials.user_header')
@endsection

@section('mainmenu')
    @include('rapiden_layouts.partials.mainmenu')
@endsection

@section('content')
   {!! $page->body !!}
@endsection



