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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@test')->name('test');
Route::get('/content', 'HomeController@content');
Route::get('/section', 'HomeController@section');

Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>'auth'], function (){
    Route::get('/','PageController@index')->name('main-group');

    Route::group(['prefix' => 'add', 'middleware' => 'auth'], function (){
        Route::get('/','PageController@add')->name('add-group');

        Route::get('/show', 'DataController@ajaxShow');
        Route::get('/parent', 'DataController@parent');

        Route::get('/edit', 'DataController@edit');
        Route::get('/remove', 'DataController@remove');
        Route::get('/ad-gr','DataController@addMainGroup');
        Route::get('/ad-con','DataController@addContent');
        Route::get('/ad-sec','DataController@addSection');
    });
});


