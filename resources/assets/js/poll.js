
  $('.poll_answers input[type="radio"]').prop('checked', false);

    $('#button_submit_poll').click(function(){
        var answer_id=($('input[name=poll_radio]:checked').val()).split("_")[1];
        var poll_id=($('input[name=poll_radio]:checked').val()).split("_")[0];
        $.get(
            "/answer/submit",
            {'answer_submit':answer_id,'poll_id':poll_id},
            function( data ) {
                //alert(data['view_html']);
                $('#answers_buttons_container').html(data['view_html']);
            });
    });
    $('.button_see_results').click(function(){
        var poll_id=$(this).attr('id').split('_')[3];
        $.get(
            "/answer/results",
            {'poll_id':poll_id},
            function( data ) {
                //alert(data['view_html']);
                $('#answers_buttons_container').html(data['view_html']);
            });
    });
    $( document ).ajaxComplete(function() {
        console.log("ok");
        $('.progress-bar').each(function() {
            var bar_value = $(this).attr('aria-valuenow') + '%';
            $(this).animate({ width: bar_value }, { duration: 10 });
        });
    });
