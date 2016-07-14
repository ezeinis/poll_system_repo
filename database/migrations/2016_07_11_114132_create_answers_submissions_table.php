<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_submissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip', 255);
            $table->string('session', 50);
            $table->string('browser', 25);
            $table->string('os', 15);
            $table->integer('answer_id')->unsigned();
            $table->foreign('answer_id')->references('id')->on('questions_answers');
            // $table->integer('user_id')->unsigned();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('poll_id')->unsigned();
            $table->foreign('poll_id')->references('id')->on('polls')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('answer_submissions');
    }
}
