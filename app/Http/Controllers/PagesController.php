<?php

namespace App\Http\Controllers;
use App\Poll;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Cookie;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $polls = Poll::where('is_open',1)->where(function ($query) {
            $current_date = new Carbon();
            $current_date = Carbon::now('Europe/Moscow');
            $query->where('closed_at', NULL)
                    ->orWhere('closed_at', '>', $current_date);
        })->with('question','answers')->get();

        $pollVotedFromUser=[];
        $pollResultsCanBeSeenByUser=[];
        $dic=NULL;
        $polls_submitted_cookie=Cookie::get('poll_ids');
        if(!$polls->isEmpty()){
            foreach($polls as $poll){
                $pollResultsCanBeSeenByUser[$poll->id]=$poll->user_can_see_results;
                if($polls_submitted_cookie==NULL){
                    $pollVotedFromUser[$poll->id]=0;
                }
                else if(in_array($poll->id, $polls_submitted_cookie)){
                    $pollVotedFromUser[$poll->id]=1;
                }else{
                    $pollVotedFromUser[$poll->id]=0;
                }
            }
        }
        $pollVotedFromUserJS=json_encode($pollVotedFromUser);
        $pollResultsCanBeSeenByUserJS=json_encode($pollResultsCanBeSeenByUser);
        $dic=NULL;
        if(!$polls->isEmpty()){
            foreach($polls as $poll){
                $dic[$poll->id]= DB::select( DB::raw("SELECT CAST(answer_submissions.created_at AS DATE) AS date,answer_id,count(*) AS count,`text` AS a_text FROM poll_system_db.answer_submissions,poll_system_db.questions_answers WHERE answer_submissions.poll_id=$poll->id AND questions_answers.id=answer_submissions.answer_id GROUP BY 1,answer_id;"));
            }
        }
        $dic = json_encode($dic);
        return view('index',compact('polls','pollVotedFromUser','pollResultsCanBeSeenByUser','pollVotedFromUserJS','pollResultsCanBeSeenByUserJS','dic'));
    }

    public function administrator()
    {
        $user_id = Auth::user()->id;
        $polls = Poll::where('user_id',$user_id)->with('question','answers')->get();
        $current_date = new Carbon();
        $current_date = Carbon::now('Europe/Moscow');
        foreach($polls as $poll){
            if($poll->closed_at!=NULL){
                if($poll->closed_at<$current_date){
                    $poll->is_open = 0;
                    $poll->closed_at=NULL;
                    $poll->save();
                }
            }
        }
        return view('administration.index',compact('polls'));
    }


    public function administratorCreatePoll()
    {
        return view('administration.createPoll');
    }
}
