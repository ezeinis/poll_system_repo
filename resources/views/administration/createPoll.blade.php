@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="/css/jquery-ui.min.css">
<link rel="stylesheet" href="/css/jquery.timepicker.min.css">
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
<a class="navbar-brand" href="/administrator">Poll System Administration</a>
</div>

<!-- COLLAPSIBLE NAVBAR -->
<div class="collapse navbar-collapse" id="alignment-example">

<!-- Links -->
<ul class="nav navbar-nav navbar-right">
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
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                <h4>Poll details</h4>
                </div>
                <div class="panel-body">
                    <form action="/poll/create" method="GET">
                        <div id="1">
                        <div class="form-group">
                            <label for="poll_title">Title</label>
                            <input type="text" class="form-control" id="poll_title" name="poll_title" required>
                        </div>
                        <div class="form-group">
                            <label for="q_text">Question</label>
                            <input type="text" class="form-control" id="q_text" name="q_text" required>
                        </div>
                        <div class="form-group">
                            <label for="q_text">Answers</label>
                        </div>
                        <div class="form-group">
                            1.<input style="display:inline-block" type="text" class="form-control" id="answer_1" name="answer_1" required>
                        </div>
                        <div class="form-group">
                            2.<input style="display:inline-block" type="text" class="form-control" id="answer_2" name="answer_2" required>
                        </div>
                        <div class="form-group">
                            3.<input style="display:inline-block" type="text" class="form-control" id="answer_3" name="answer_3">
                        </div>
                        </div>
                        <div class="form-group">
                            <button id="add_answer_btn" type="button" class="btn btn-primary">Add answer</button>
                        </div>
                        <p><input type="checkbox" id="enable" name="enable" val=""> Poll's closing date and time: <input type="text" id="datepicker" name="datepicker" disabled><input type="text" id="timepicker" name="timepicker" disabled></p>
                        <div class="checkbox">
                            <label><input type="checkbox" id="show_results" name="show_results" val="">Show results to user after submitting an answer</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="is_open" class="radio-inline" value="1" checked> Open
                            <input type="radio" name="is_open" class="radio-inline" value="0"> Closed
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default">Create New Poll</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/jquery.timepicker.min.js"></script>
    <script type="text/javascript">

        $('#enable').click(function(){
            if ($('#enable').is(":checked"))
            {
                $("#datepicker").prop('disabled', false);
                $("#timepicker").prop('disabled', false);
                $("#datepicker").prop('required',true);
                $("#timepicker").prop('required',true);
            }else{
                $("#datepicker").prop('disabled', true);
                $("#timepicker").prop('disabled', true);
                $("#datepicker").prop('required',false);
                $("#timepicker").prop('required',false);
            }
        });

        var answer_counter=4;
        $("#add_answer_btn").click(function(){
            $("#1").append("<div class='form-group'>"+answer_counter+".<input style='display:inline-block' type='text' class='form-control' id='answer_"+answer_counter+"' name='answer_"+answer_counter+"'></div>");
            answer_counter++;
        });

        $(function() {
            $( "#datepicker" ).datepicker();
            $('#timepicker').timepicker();
        });


    </script>
@stop
