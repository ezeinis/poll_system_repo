@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.3/jquery.timepicker.min.css">
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
    @include('includes.flash')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                <h4>Poll details</h4>
                </div>
                <div class="panel-body">
                    <form action="/poll/{{$poll->id}}" method="POST">
                    <input type="hidden" name="_method" value="put" />
                    {{ csrf_field() }}
                        <div id="1">
                        <div class="form-group">
                            <label for="poll_title">Title</label>
                            <input type="text" class="form-control" id="poll_title" name="poll_title" value="{{$poll->title}}" required>
                        </div>
                        <div class="form-group">
                            <label for="q_text">Question</label>
                            <input type="text" class="form-control" id="q_text" name="q_text" value="{{$poll->question->text}}" required>
                        </div>
                        <div class="form-group">
                            <label for="q_text">Answers</label>
                        </div>
                        <div class="row">
                            <div class="col-md-1">
                            1.
                            </div>
                            <div class="form-group col-md-9">
                                <input style="display:inline-block" type="text" class="form-control" id="answer_1" name="answers[{{$poll->answers[0]->id}}]" value="{!! $poll->answers[0]->text !!}" required>
                            </div>
                            <div class="col-md-2">
                            <a class="btn btn-danger" href="/question/{{$poll->question->id}}/answer/{{$poll->answers[0]->id}}/delete">Delete</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1">
                            2.
                            </div>
                            <div class="form-group col-md-9">
                                <input style="display:inline-block" type="text" class="form-control" id="answer_2" name="answers[{{$poll->answers[1]->id}}]" value="{!! $poll->answers[1]->text !!}" required>
                            </div>
                            <div class="col-md-2">
                            <a class="btn btn-danger" href="/question/{{$poll->question->id}}/answer/{{$poll->answers[1]->id}}/delete">Delete</a>
                            </div>
                        </div>
                        @if($no_answers>2)
                            @for ($i=3;$i<=$no_answers;$i++)
                            <div class="row">
                            <div class="col-md-1">
                            {{$i}}.
                            </div>
                            <div class="form-group col-md-9">
                                <input style="display:inline-block" type="text" class="form-control" id="answer_{{$i}}" name="answers[{{$poll->answers[$i-1]->id}}]" value="{!! $poll->answers[$i-1]->text !!}">
                            </div>
                            <div class="col-md-2">
                            <a class="btn btn-danger" href="/question/{{$poll->question->id}}/answer/{{$poll->answers[$i-1]->id}}/delete">Delete</a>
                            </div>
                            </div>
                            @endfor
                        @endif
                        </div>
                        <div class="form-group">
                            <button id="add_answer_btn" type="button" class="btn btn-primary">Add answer</button>
                        </div>
                        @if($poll->closed_at==NULL)
                            <p><input type="checkbox" id="enable" name="enable" val=""> Poll's closing date and time: <input type="text" id="datepicker" name="datepicker" disabled><input type="text" id="timepicker" name="timepicker" disabled></p>
                        @else
                            <p><input type="checkbox" id="enable" name="enable" val="" checked> Poll's closing date and time: <input type="text" id="datepicker" name="datepicker" value="{{$date}}"><input type="text" id="timepicker" name="timepicker" value="{{$time}}"></p>
                        @endif
                        <div class="checkbox">
                            <label><input type="checkbox" id="show_results" name="show_results"
                            @if($poll->user_can_see_results==1)
                                {{"checked"}}
                            @endif
                            >Show results to user after submitting an answer</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="is_open" class="radio-inline" value="1"
                            @if($poll->is_open){{"checked"}}@endif> Open
                            <input type="radio" name="is_open" class="radio-inline" value="0"
                            @if(!$poll->is_open){{"checked"}}@endif> Closed
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default">Update Poll</button>
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
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.3/jquery.timepicker.min.js"></script>
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

        var answer_counter={{$no_answers+1}};
        $("#add_answer_btn").click(function(){
            $("#1").append("<div class='form-group'>"+answer_counter+".<input style='display:inline-block' type='text' class='form-control' id='answer_"+answer_counter+"' name='answers_extra["+answer_counter+"]'></div>");
            answer_counter++;
        });

        $(function() {
            $( "#datepicker" ).datepicker();
            $('#timepicker').timepicker();
        });


    </script>
@stop
