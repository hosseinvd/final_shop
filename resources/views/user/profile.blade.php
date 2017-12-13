@extends('layouts.master')
@section('title')
    {{auth()->user()->name}}
@endsection
@section('content')
 <h1>Hello User</h1>
@endsection
