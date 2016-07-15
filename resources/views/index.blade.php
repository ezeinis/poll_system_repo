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
<script type="text/javascript">

    $('.poll_answers input[type="radio"]').prop('checked', false);

    $('.poll_answers').click(function(){
        var answer=$(this).attr('id');
        var id = answer.split("_")[1];
        $('#input_'+id).prop('checked', true);
        $('.poll_answers').css('background-color', '#d2d2d2');
        $('#answer_'+id).css('background-color', '#b9d7e6');
    });

    $('#button_submit_poll').click(function(){
        var answer_id=($('input[name=poll_radio]:checked').val()).split("_")[1];
        var poll_id=($('input[name=poll_radio]:checked').val()).split("_")[0];
        $.get(
            "/answer/submit",
            {'answer_submit':answer_id,'poll_id':poll_id},
            function( data ) {
                //alert(data['view_html']);
                $('#replace_container').html(data['view_html']);
            });
        });
    $( document ).ajaxComplete(function() {
        console.log("ok");
        $('.progress-bar').each(function() {
            var bar_value = $(this).attr('aria-valuenow') + '%';
            $(this).animate({ width: bar_value }, { duration: 10 });
        });
    });



</script>
@stop
<!-- SELECT CAST(poll_submissions.created_at AS DATE),answer_id,a_text,count(*) FROM poll_system_db.poll_submissions,poll_system_db.answers WHERE poll_id=8 AND answers.id=answer_id GROUP BY 1,answer_id; -->
<!-- SELECT CAST(answer_submissions.created_at AS DATE) FROM poll_system_db.answer_submissions GROUP BY 1; -->
