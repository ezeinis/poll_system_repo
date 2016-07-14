<?php

namespace App;
use App\User;
use App\Question_Answers;
use App\Poll_submission;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model

{

    protected $table = 'polls';

    public function user()

    {

        return $this->belongsTo(User::class);

    }

    public function question_answers()

    {

        return $this->hasMany(Question_Answers::class);

    }

    public function question()

    {

        return $this->hasOne(Question_Answers::class)->where('type','q');

    }

    public function answers()

    {

        return $this->hasMany(Question_Answers::class)->where('type','a');

    }

    // public function question()

    // {

    //     return $this->hasOne(Question_Answers::class);

    // }

    // public function answers()

    // {

    //     return $this->hasMany(Question_Answers::class);

    // }

    // public function get_q_and_as()
    // {
    //     return Question_Answers::where('type','q')->where('poll_id',$this->id)->get();
    // }

    // public function submissions()

    // {

    //     return $this->hasMany(Poll_submission::class);

    // }


    // public function hasVoteFromUser()
    // {
    //     $ip = request()->ip();

    //     $submission = Poll_submission::where('poll_id',$this->id)->where('user_ip_address',$ip)->get();
    //     if(count($submission)==0){
    //         return 0;
    //     }else{
    //         return 1;
    //     }
    // }
}
