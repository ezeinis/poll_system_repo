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
            <div class="poll_answers">
                <input type="radio" name="poll_radio" id="answer_{{$answer->id}}" value="{{$poll->id}}_{{$answer->id}}"/>
                <label for="answer_{{$answer->id}}"><h4>{{$answer->text}}</h4></label>
            </div>
        @endforeach
        </div>
        <div class="row poll_buttons">
            @if(Cookie::get('poll_ids')==NULL)
            <button id="button_submit_poll" type="submit" class="btn btn-default col-xs-12">Ψήφισε</button>
            @else
            <div class="col-xs-6"><button id="button_submit_poll" type="submit" class="btn btn-default col-xs-12">Ψήφισε</button></div>
            <div class="col-xs-6"><button id="button_see_results_{{$poll->id}}" type="submit" class="btn btn-default col-xs-12 button_see_results">Αποτελέσματα</button></div>
            @endif
        </div>
    </div>
@endforeach
</div>


