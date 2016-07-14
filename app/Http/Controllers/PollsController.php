<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
use App\Question_Answers;
use App\Answer;
use App\Answer_submission;
use Auth;
use App\Http\Requests;
use DateTime;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Session;
use BrowserDetect;
use Cookie;

class PollsController extends Controller

{
    //create poll from admin
    public function create(Request $request)

    {

        //polls
        $poll = new Poll;
        $user_id = Auth::user()->id;
        $poll->user_id = $user_id;
        $poll->title = $request->poll_title;
        $poll->created_at = new DateTime;
        if($request->has('datepicker')){
            $poll->closed_at = $this->convert_pickers_to_datetime_object($request->datepicker,$request->timepicker);
        }
        $poll->is_open = $request->is_open;
        if($request->show_results==="on"){$poll->user_can_see_results = 1;}else{$poll->user_can_see_results = 0;}
        $poll->save();

        //questions
        $question = new Question_Answers(['text' => $request->q_text,'priority' => 0, 'id_path' => '']);
        $question->type='q';
        $poll->question()->save($question);
        $question->id_path='/'.$question->id.'/';
        $question->save();

        //answers
        $as=[
        ];
        $answers_counter = $this->answers_submitted($request);
        for($i=1;$i<$answers_counter+1;$i++){
             $a = new Question_Answers;
             $a->parent=$question->id;
             $a->text=$request->input('answer_'.$i);
             $a->type='a';
             $a->priority=$i-1;
             array_push($as,$a);
        }
        $poll->answers()->saveMany($as);
        foreach ($as as $answer) {
            $answer->id_path="/".$answer->parent."/".$answer->id."/";
            $answer->save();
        }
        flash('Poll created','success');
        return redirect('/administrator');
    }

    public function edit($poll_id)
    {
        $poll = Poll::where('id',$poll_id)->with('question','answers')->first();
        //
        $no_answers = $poll->answers->count();
        $date = "";
        $time = "";
        if($poll->closed_at!=NULL){
            $date = $this->convert_datetime_object_to_date_picker($poll->closed_at);
            $time = $this->convert_datetime_object_to_time_picker($poll->closed_at);
        }
        return view('administration.editPoll',compact('poll','no_answers','date','time'));
    }

    public function update($poll_id,Request $request)
    {
        //return $request;
        //update poll
        $poll_to_update = Poll::find($poll_id);
        $poll_to_update->title=$request->poll_title;
        if($request->has('datepicker')){
            $poll_to_update->closed_at = $this->convert_pickers_to_datetime_object($request->datepicker,$request->timepicker);
        }else{
            $poll_to_update->closed_at = NULL;
        }
        if($request->show_results==="on"){$poll_to_update->user_can_see_results = 1;}else{$poll_to_update->user_can_see_results = 0;}
        $poll_to_update->is_open=$request->is_open;
        $poll_to_update->save();
        //update question
        $question_to_update = $poll_to_update->question;
        $question_to_update->text=$request->q_text;
        // $question_to_update = Question::where('poll_id',$poll_id)->first();
        // $question_to_update->q_text=$request->q_text;
        $question_to_update->save();
        //update answers
        foreach(array_keys($request->answers) as $key){
            $answer_to_update = Question_Answers::find($key);
            $answer_to_update->text = $request->answers[$key];
            $answer_to_update->save();
        }
        if($request->has('answers_extra')){
            foreach(array_keys($request->answers_extra) as $key){
                $answer_to_create = new Question_Answers;
                //return $request->answers_extra[$key];
                $answer_to_create->poll_id=$poll_to_update->id;
                $answer_to_create->parent=$question_to_update->id;
                $answer_to_create->text=$request->answers_extra[$key];
                $answer_to_create->type='a';
                $answer_to_create->priority=$key-1;
                $answer_to_create->save();
            }
            //return array_keys($request->answers_extra);
        }
        flash('Poll updated','success');
        return redirect('/administrator');
    }


    public function answers_submitted(Request $request)

    {

        $counter = 1;
        while(true){
            if(!$request->has('answer_'.$counter)){
                $counter--;
                break;
            }
            $counter++;
        }
        return $counter;

    }

    //save poll_submission by user
    public function save_answer(Request $request)
    {
        // if($this->userAlreadySubmitedPoll($request->poll_id)){
        //     session()->flash('save_answer_error','You cannot submit an answer to the same poll more than once');
        //     return back();
        // }
        $browser_info = BrowserDetect::detect();
        //dd(Cookie::get('poll_ids'));
        if(!$request->has('optradio')){
            flash('You have to choose one answer','danger');
            return back();
        }
        $answer = Question_Answers::find($request->optradio);
        $ip = request()->ip();
        //session()->flash('answers_counter_flash',$answers_counter);
        $answer_submission = new Answer_submission;
        $answer_submission->ip=$ip;
        $answer_submission->answer_id=$answer->id;
        $answer_submission->poll_id=$request->poll_id;
        $answer_submission->session=Session::getId();
        $answer_submission->browser=$browser_info->browserFamily;
        $answer_submission->os=$browser_info->osFamily;
        if($this->userAlreadySubmitedPoll($request->poll_id)){
            flash('You are not allowed to submit another answer for this poll','danger');
                 return back();
        }else{
            $answer_submission->save();
            $answer->submissions_counter=$answer->submissions_counter+1;
            $answer->save();
            $poll=Poll::find($request->poll_id);
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
        // try{
        //   $answer_submission->save();
        //   Cookie::queue(Cookie::forever('answer_submission_id', $answer_submission->id));
        // }
        // catch (QueryException $e){$errorCode = $e->errorInfo[1];
        //     if($errorCode == 1062){
        //         flash('You are not allowed to submit another answer for this poll','danger');
        //         return back();
        //     }
        // }
        flash('Thank you for submitting your answer','success');
        //session()->flash('show_results',$request->poll_id);
        return back();
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

    // public function openPoll($poll_id)
    // {
    //     $current_date = new Carbon();
    //     $current_date = Carbon::now('Europe/Moscow');
    //     $poll = Poll::find($poll_id);
    //     if($poll->closed_at!=NULL){
    //         if($current_date>$poll->closed_at){
    //             flash("edit poll first so that it's closing datetime is not past current datetime",'danger');
    //             return back();
    //         }else{
    //             $poll->is_open = 1;
    //             $poll->save();
    //         }
    //     }else{
    //         $poll->is_open = 1;
    //         $poll->save();
    //     }
    //     flash('poll opened','success');
    //     return back();
    // }

    public function openPoll($poll_id)
    {
        $poll = Poll::find($poll_id);
        $poll->is_open = 1;
        $poll->save();
        flash('poll is now open to public','success');
        return back();
    }

    public function closePoll($poll_id)
    {
        $poll = Poll::find($poll_id);
        $poll->is_open = 0;
        $poll->closed_at=NULL;
        $poll->save();
        flash('poll closed','success');
        return back();
    }

    public function deletePoll($poll_id)
    {
        $poll=Poll::find($poll_id);
        $poll->delete();
        flash('poll deleted','success');
        return back();
    }

    public function deleteAnswer($question_id,$answer_id)
    {
        if(Question_Answers::find($question_id)->answers()->count()<=2){
            flash("Can't have less than two answers for a question",'danger');
            return back();
        }
        $answer_to_delete = Question_Answers::find($answer_id)->delete();
        flash('Poll updated','success');
        return back();
    }

    protected function convert_pickers_to_datetime_object($date,$time)
    {
        $date = explode("/",$date);
        $new_date = $date[2]."-".$date[0]."-".$date[1];
        $temp=explode(" ",$time);
        $temp[0]=explode(":",$temp[0]);
        if($temp[1]==="PM"){$temp[0][0]=(intval($temp[0][0])+12)."";}
        $new_time=$temp[0][0].":".$temp[0][1].":00";
        return $new_date." ".$new_time;
    }

    protected function convert_datetime_object_to_date_picker($dt)

    {

        $date = explode(" ",$dt);
        $date_exploded = explode("-",$date[0]);
        $final_date = $date_exploded[1]."/".$date_exploded[2]."/".$date_exploded[0];
        return $final_date;

    }

    protected function convert_datetime_object_to_time_picker($dt)

    {

        $time = explode(" ",$dt);
        $time_exploded = explode(":",$time[1]);
        if(intval($time_exploded[0])>12){
            $final_time = (intval($time_exploded[0])-12).":".$time_exploded[1]." PM";
        }else{
            $final_time = $time_exploded[0].":".$time_exploded[1]." AM";
        }

        return $final_time;

    }
}
