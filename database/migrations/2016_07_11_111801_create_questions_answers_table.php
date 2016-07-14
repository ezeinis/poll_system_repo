<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type',1);
            $table->integer('poll_id')->unsigned();
            $table->foreign('poll_id')->references('id')->on('polls')->onDelete('cascade');
            $table->integer('priority');
            $table->integer('parent')->nullable();
            //$table->foreign('parent')->references('id')->on('question_answers')->onDelete('cascade');
            $table->string('text');
            $table->integer('submissions_counter')->default(0);
            $table->string('id_path');
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
        Schema::drop('questions_answers');
    }
}
