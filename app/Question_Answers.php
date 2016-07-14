<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question_Answers extends Model
{
    protected $table = "questions_answers";
    protected $fillable = [
        'text'
    ];

    public function answers()

    {

        $answers = Question_Answers::where('parent',$this->id)->get();
        return $answers;

    }

    public function question()

    {

        $question = Question_Answers::find($this->parent);
        return $question;

    }

}
