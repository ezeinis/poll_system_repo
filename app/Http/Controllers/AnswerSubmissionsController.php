<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use BrowserDetect;
use Cookie;
use Session;
use App\Poll;
use App\Question_Answers;
use App\Answer_submission;

class AnswerSubmissionsController extends Controller
{
    public function saveAnswer(Request $request)
    {
        $browser_info = BrowserDetect::detect();
        $answer = Question_Answers::find($request->answer_submit);
        $ip = request()->ip();

        $answer_submission = new Answer_submission;
        $answer_submission->ip=$ip;
        $answer_submission->answer_id=$answer->id;
        $answer_submission->poll_id=$request->poll_id;
        $answer_submission->session=Session::getId();
        $answer_submission->browser=$browser_info->browserFamily;
        $answer_submission->os=$browser_info->osFamily;
        $poll=Poll::find($request->poll_id);
        if($this->userAlreadySubmitedPoll($request->poll_id)){
            $type="danger";
            $poll_message="Δεν μπορείτε να ψηφίσετε πάλι στο ίδιο poll!";
            return ['view_html'=>view('includes.tv_poll_view_results',compact('poll','poll_message','type'))->render()];
        }else{
            $answer_submission->save();
            $answer->submissions_counter=$answer->submissions_counter+1;
            $answer->save();
            $poll->total_poll_submissions=$poll->total_poll_submissions+1;
            $poll->save();
            if(Cookie::get('poll_ids')!=NULL){
                $polls=Cookie::get('poll_ids');
                array_push($polls, $request->poll_id);
                Cookie::queue(Cookie::forever('poll_ids', $polls));
            }else{
                $polls=[$request->poll_id];
                Cookie::queue(Cookie::forever('poll_ids', $polls));
            }
        }
        $poll_message="Ευχαριστούμε που ψηφίσατε!";
        $type="success";
        return ['view_html'=>view('includes.tv_poll_view_results',compact('poll','poll_message','type'))->render()];
    }

    public function showPollResults(Request $request)
    {
        $poll=Poll::find($request->poll_id);
        $type="warning";
        $poll_message="Έχετε ήδη ψηφίσει σε αυτό το poll!";
        return ['view_html'=>view('includes.tv_poll_view_results',compact('poll','poll_message','type'))->render()];
    }

    protected function userAlreadySubmitedPoll($poll_id)
    {
        $polls=Cookie::get('poll_ids');
        if($polls==NULL)return 0;
        if(in_array($poll_id, $polls)){
            return 1;
        }else{
            return 0;
        }
    }
}
