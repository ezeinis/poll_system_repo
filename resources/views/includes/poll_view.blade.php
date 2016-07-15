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
                            <h4>{{$poll->question->text}}</h4>
                        </div>
                        @foreach($poll->answers as $answer)
                            <div class="row">
                                <div class="col-md-1" style="text-align:center;">
                                    <input type="radio" name="optradio" value="{{$answer->id}}">
                                </div>
                                <div class="col-md-4" style="word-wrap: break-word;">
                                    <label>{{$answer->text}}</label>
                                </div>
                                @if($pollVotedFromUser[$poll->id])
                                    @if($pollResultsCanBeSeenByUser[$poll->id])
                                    <div class="col-md-1">
                                        {{$answer->submissions_counter}}
                                    </div>
                                    <div class="progress">
                                        <?php $per=calculate_percentage($poll->answers,$poll->total_poll_submissions,$answer->id); ?>
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
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
