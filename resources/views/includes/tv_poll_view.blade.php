<div id="poll_container">
@foreach($polls as $poll)
    <div class="row">
        <div class="col-sm-12 poll_header">
            <h4>{{$poll->question->text}}</h4>
        </div>
    </div>
    <div id="replace_container">
        <div class="row">
            @foreach($poll->answers as $answer)
            <div id="answer_{{$answer->id}}" class="row poll_answers">
                <div class="col-sm-2">
                    <input id="input_{{$answer->id}}" type="radio" name="poll_radio" value="{{$poll->id}}_{{$answer->id}}">
                </div>
                <div class="col-sm-10">
                    <h4>{{$answer->text}}</h4>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row poll_buttons">
            <button id="button_submit_poll" type="submit" class="btn btn-default col-sm-12">Ψήφισε</button>
        </div>
    </div>
@endforeach
</div>


