@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="css/poll.css">
@stop

@section('nav')
<nav class="navbar navbar-default">
    <!-- Brand -->
    <a class="navbar-brand" href="">Poll System</a>
</nav>
@stop

@section('content')
<div class="container">
    @include('includes.flash')
    <div style="width:301px;height:650px;">
        @include('includes.tv_poll_view')
    </div>
</div>
@stop

@section('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="js/poll.js"></script>

@stop

