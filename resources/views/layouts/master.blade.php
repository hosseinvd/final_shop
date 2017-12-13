<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="{{asset('css/admin.css')}}"  crossorigin="anonymous">

    <script src="{{asset('js/jquery.min.js')}}" ></script>
    <script src="{{asset('js/popper.min.js')}}" ></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    @yield('styles')
</head>
<body>
@include('partials.header')
<div class="container ">
    @yield('content')
</div>

<script>
    $(document).ready(function(){
        $("#myBtn").click(function(){
            $("#myModal").modal();
        });
    });
</script>
@yield('scripts')
</body>
</html>

