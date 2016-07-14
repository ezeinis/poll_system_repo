@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@stop

@section('nav')
<nav class="navbar navbar-default">
    <!-- Brand -->
    <a class="navbar-brand" href="">Poll System</a>
</nav>
@stop

@section('content')
<div class="container">
    <?php $i=0; ?>
    @include('includes.flash')
    @foreach($polls as $poll)
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>{{$poll->title}}</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            @if($poll->closed_at!=NULL AND $poll->is_open)
                                <h5>closes at {{$poll->closed_at}}</h5>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="/answer/save" method="GET">
                        <div class="form-group">
                            <h4>{{$poll->question->q_text}}</h4>
                        </div>
                        @foreach($answers[$i] as $answer)
                            <div class="row">
                                <div class="col-md-1" style="text-align:center;">
                                    <input type="radio" name="optradio" value="{{$answer->id}}">
                                </div>
                                <div class="col-md-4" style="word-wrap: break-word;">
                                    <label>{{$answer->a_text}}</label>
                                </div>
                               @if($pollVotedFromUser[$poll->id])
                                    @if($pollResultsCanBeSeenByUser[$poll->id])
                                    <div class="col-md-1">
                                        {{$answer->total_submissions()}}
                                    </div>
                                    <div class="progress">
                                        <?php $per=$answer->percentage($poll->id); ?>
                                        <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="min-width:2em;width: {{$per}}%;">
                                        {{$per}}%
                                        </div>
                                    </div>
                                    @endif
                                @endif
                            </div>
                        @endforeach
                        <input type="hidden" name="poll_id" value="{{$poll->id}}">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group" style="margin-top:10px;">
                                    <button type="submit" class="btn btn-default">Submit</button>
                                    <!-- @if($pollVotedFromUser[$poll->id])
                                        @if($pollResultsCanBeSeenByUser[$poll->id])
                                            <a id="{{$poll->id}}" class="btn btn-default">Show Results</a>
                                        @endif
                                    @endif -->
                                </div>
                            </div>
                            @if($pollVotedFromUser[$poll->id])
                                @if($pollResultsCanBeSeenByUser[$poll->id])
                                <div class="col-md-7">
                                    <div id="pie_poll_{{$poll->id}}" class="pie" style="height:200px;">

                                    </div>
                                </div>
                                @endif
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php $i++; ?>
    @endforeach
</div>
@stop

@section('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script type="text/javascript">

    $('input[type="radio"]').prop('checked', false);
    $("a.btn-default").click(function(){
        $(".poll-bar-results").removeClass('hidden');
        $(".poll-bar-results").addClass('visible');
    });
    var submissions_data = <?php echo $dic; ?>;
    var hasAnswer = <?php echo $pollVotedFromUserJS; ?>;
    var canSeeResults = <?php echo $pollResultsCanBeSeenByUserJS; ?>;
    //console.log(submissions_data);

    $.each(submissions_data,function(poll_id,obj){
        //console.log(hasAnswer[poll_id]);
        //console.log(canSeeResults[poll_id]);
        if(hasAnswer[poll_id]==1 && canSeeResults[poll_id]==1){//ean ta results tou poll mporei na ta dei o xrhsths
            temp_date="";
            var i = -1;
            var dic = {};
            var moris_obj = {
                element: 'pie_poll_'+poll_id,
                data:[],
                xkey:'year',
                ykeys:[],
                labels:[]
            };
            //console.log(poll_id);
            $.each(obj,function(idx,row){
                // console.log(idx);
                // console.log(row['date']);
                // console.log(temp_date);
                // console.log(i);
                if(temp_date!=row['date']){
                    //console.log("kainourio entry");
                    i++;
                    moris_obj.data.push({"year":row.date});
                    moris_obj.data[i][row.a_text]=row.count;
                    if(moris_obj.labels.indexOf(row.a_text)==-1){
                        moris_obj.ykeys.push(row.a_text);
                        moris_obj.labels.push(row.a_text);
                    }
                }else{
                    //console.log("edit entry");
                    moris_obj.data[i][row.a_text]=row.count;
                    if(moris_obj.labels.indexOf(row.a_text)==-1){
                        moris_obj.ykeys.push(row.a_text);
                        moris_obj.labels.push(row.a_text);
                    }
                }
                temp_date = row['date'];
                //console.log(row['a_text']);
                //console.log(dic);
            });

            new Morris.Line({
                element: moris_obj.element,
                data: moris_obj.data,
                xkey: moris_obj.xkey,
                ykeys: moris_obj.ykeys,
                labels: moris_obj.labels
            });
        }
    });

</script>
@stop
<!-- SELECT CAST(poll_submissions.created_at AS DATE),answer_id,a_text,count(*) FROM poll_system_db.poll_submissions,poll_system_db.answers WHERE poll_id=8 AND answers.id=answer_id GROUP BY 1,answer_id; -->
