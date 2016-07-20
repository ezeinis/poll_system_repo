<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::resource('poll','PollsController');

Route::get('/question/{question_id}/answer/{answer_id}/delete','PollsController@deleteAnswer');

Route::get('/poll/{poll_id}/open','PollsController@openPoll');

Route::get('/poll/{poll_id}/close','PollsController@closePoll');

Route::get('/poll/{poll_id}/delete','PollsController@deletePoll');

Route::get('/answer/save', 'PollsController@save_answer');

Route::get('/', 'PagesController@index');

Route::get('/index', 'PagesController@index');

Route::get('/administrator', 'PagesController@administrator');

Route::get('/administrator/new_poll', 'PagesController@administratorCreatePoll');

Route::get('/answer/submit','AnswerSubmissionsController@saveAnswer');

Route::get('/answer/results','AnswerSubmissionsController@showPollResults');
