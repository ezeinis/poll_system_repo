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
                <div class="progress-bar dp-answer-color-{{$answer->priority}}" role="progressbar" aria-valuemin="0" aria-valuenow="{{$per}}" aria-valuemax="100" style="">
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
        <div id="poll-message" class="alert alert-{{$type}}"> {{$poll_message}}</div>
    @endif
