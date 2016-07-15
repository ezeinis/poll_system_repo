    <div class="row">
    @if($poll->total_poll_submissions!=0)
    @foreach($poll->answers as $answer)

    <div id="answer_{{$answer->id}}" class="row poll_answers">
        <div class="row">
        <div class="col-sm-12">
            <h4>{{$answer->text}}</h4>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-9">
            <div class="progress">
                <?php $per=calculate_percentage($poll->answers,$poll->total_poll_submissions,$answer->id); ?>
                <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:{{$per}}%;">
                <span>{{$answer->submissions_counter}}</span>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
        {{$per}}%
        </div>
        </div>
    </div>
    @endforeach
    </div>
    <div class="row">
        <div id="poll_message" class="col-sm-12">
            <span class="{{$type}}"> {{$poll_message}}</span>
        </div>
    </div>
    @endif
