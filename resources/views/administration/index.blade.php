@extends('layouts.app')

@section('head')
<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
@stop

@section('nav')
<nav class="navbar navbar-default">
<div class="container-fluid">

<!-- BRAND -->
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#alignment-example" aria-expanded="false">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="">Poll System Administration</a>
</div>

<!-- COLLAPSIBLE NAVBAR -->
<div class="collapse navbar-collapse" id="alignment-example">

<!-- Links -->
<ul class="nav navbar-nav navbar-right">
<li><a href="administrator/new_poll">+ New Poll</a></li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}} <span class="caret"></span></a>
<ul class="dropdown-menu" aria-labelledby="about-us">
<li><a href="/logout">Logout</a></li>
</ul>
</li>
</ul>
</div>
</div>
</nav>
@stop

@section('content')
    <div class="container">
    @include('includes.flash')
    @foreach($polls as $poll)
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-4">
                        <h4>{{$poll->title}}</h4>
                        </div>
                        <div class="poll_status_index_page col-md-6 col-md-offset-2">
                            <div class="poll_status_dropdown dropdown">
                                @if($poll->is_open==1)
                                <button class="btn btn-success dropdown-toggle" type="button" id="about-us" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Open
                                @else
                                <button class="btn btn-danger dropdown-toggle" type="button" id="about-us" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Closed
                                @endif
                                <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="about-us">
                                @if($poll->is_open==1)
                                    <li><a href="poll/{{$poll->id}}/close">Close</a></li>
                                @else
                                    <li><a href="poll/{{$poll->id}}/open">Open</a></li>
                                @endif
                                <li><a href="poll/{{$poll->id}}/edit">Edit</a></li>
                                <li><a id="delete_{{$poll->id}}" data-value="{{$poll->title}}" class="delete" href="#">Delete</a></li>
                                </ul>
                            </div>
                            <div class="open_poll_duration_info">
                                @if($poll->closed_at!=NULL && $poll->is_open)
                                    closes at {{$poll->closed_at}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 panel-body-question">
                            Q: {{$poll->question->text}}
                        </div>
                    </div>
                    @foreach($poll->answers as $answer)
                        <div class="row">
                            <div class="col-md-12">
                                {{$answer->text}}<div style="display:inline-block;width:20px;"></div>{{$answer->submissions_counter}}
                                @if($poll->total_poll_submissions==0)
                                    {{"(0 %)"}}
                                @else
                                    {{"(".calculate_percentage($poll->answers,$poll->total_poll_submissions,$answer->id)." %)"}}
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <div class="row total-submissions-info">
                        <div class="col-md-12">
                            Total submissions:{{$poll->total_poll_submissions}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@stop

@section('js')
<script src="js/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.delete').click(function(){
        var poll = $(this).attr('id');
        var poll_id=poll.split("_")[1];
        var poll_title = $(this).data('value');
        swal({
      title: poll_title,
      text: "This action will delete the poll, the question and answers associated with that!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
      },
    function(){
        $(location).attr('href', 'poll/'+poll_id+'/delete');
    });
    });

</script>
@stop
