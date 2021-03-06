<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::resource('groups', 'GroupController');
Route::resource('conversations', 'ConversationController');



Route::get('/', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@test')->name('test');
Route::get('/content', 'HomeController@content');
Route::get('/section', 'HomeController@section');

Route::group(['prefix'=> 'api'], function (){
    Route::get('/storeChat', 'ManagerController@storeChat');
    Route::get('/manager-status', 'ManagerController@status');
    Route::get('/feedback', 'ManagerController@send');
    Route::get('/verbation', 'ManagerController@verbation');
    Route::get('/send', 'ManagerController@store');
});


Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>'auth'], function (){

    Route::get('/chat', 'PageController@chat')->name('chat');

    Route::get('/','PageController@index')->name('main-group');

    Route::group(['prefix' => 'add', 'middleware' => 'auth'], function (){
        Route::get('/','PageController@add')->name('add-group');

        Route::get('/show', 'DataController@ajaxShow');
        Route::get('/parent', 'DataController@parent');

        Route::get('/edit', 'DataController@edit');
        Route::get('/remove', 'DataController@remove');
        Route::get('/add-group','DataController@addMainGroup');
        Route::post('/add-content','DataController@addContent');
        Route::post('/add-section','DataController@addSection');
    });
});


