<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'IndexController@index');


// Authentication Routes...
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout');

// Registration Routes...
Route::get('/register', 'Auth\RegisterController@showRegistrationForm');
Route::post('/register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/tournaments', 'TournamentController@index');
    Route::get('/tournament/edit/{tournament?}', 'TournamentController@edit');
    Route::post('/tournament/edit/{tournament?}', 'TournamentController@updateInsert');
    Route::get('/tournament/delete/{tournament?}', 'TournamentController@delete');
    Route::get('/tournament/detail/{tournament}', 'TournamentController@detail');

    Route::get('/tournament/{tournament}/group/edit/{group?}', 'GroupController@edit');
    Route::post('/tournament/{tournament?}/group/edit/{group?}', 'GroupController@updateInsert');


    Route::get('/group/delete/{group}', 'GroupController@delete');
    Route::get('/group/detail/{group}', 'GroupController@detail');

    Route::get('/group/{group}/schema', 'GroupController@schema');
    Route::post('/group/{group}/schema', 'GroupController@updateSchema');

    Route::get('/group/{group}/add-team/{team}', 'GroupController@addTeam');
    Route::get('/group/{group}/remove-team/{team}', 'GroupController@removeTeam');

    Route::get('/game/group/{group}/team/{team}/vs-team/{vsTeam}/team-result/{teamResult}/vs-team-result/{vsTeamResult}/start-offset/{startOffset}', 'GameController@edit');

    
    Route::get('/teams', 'TeamController@index');
    Route::get('/team/edit/{team?}', 'TeamController@edit');
    Route::post('/team/edit/{team?}', 'TeamController@updateInsert');
    Route::get('/team/delete/{team?}', 'TeamController@delete');
});
