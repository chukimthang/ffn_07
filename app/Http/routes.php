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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/news', function() {
    return view('user.home');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin'], 
    'namespace' => 'Admin'], function() {

    Route::get('/', function() {
        return view('admin.index');
    });

    Route::get('teams/search', ['as' => 'admin.teams.search', 
        'uses' => 'TeamsController@search']);
    
    Route::resource('categories', 'CategoriesController');

    Route::resource('news', 'NewsController');
    
    Route::resource('teams', 'TeamsController');

    Route::resource('league', 'LeagueController');
    
    Route::resource('country', 'CountryController');

    Route::resource('player', 'PlayerController');

    Route::resource('users', 'UserController', [
        'only' => ['index', 'update', 'destroy']
    ]);

    Route::resource('team_achievement', 'TeamAchievementController');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function() {
    Route::resource('users', 'UserController', ['only' => [
        'edit', 'update'
    ]]);
});
