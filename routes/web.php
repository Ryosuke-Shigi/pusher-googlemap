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

Route::get('/', function () {
    return view('welcome');
});

/////////////////////////////////////////////////////////////
//
//      勉強用
//
/////////////////////////////////////////////////////////////

//HTML練習用
Route::group(['prefix'=>'practice','as'=>'practice.'],function(){
    Route::get('/test01','PracticeController@Test01')->name('test01');
    Route::post('/test01','PracticeController@Test01')->name('test01');
});

Route::group(['prefix'=>'route','as'=>'route.'],function(){
    Route::get('/viewRooms','routesController@viewRooms')->name('viewRooms');
    Route::post('/viewRooms','routesController@viewRooms')->name('viewRooms');
    Route::get('/login','routesController@login')->name('login');
    Route::get('/login','routesController@login')->name('login');
    Route::get('/roomCreate','routesController@roomCreate')->name('roomCreate');
    Route::get('/roomCreate','routesController@roomCreate')->name('roomCreate');

});

Route::group(['prefix'=>'check','as'=>'check.'],function(){
    Route::get('/viewer','checkController@viewer')->name('viewer');
    Route::post('/checker','checkController@checker')->name('checker');
    Route::post('/commenter','checkController@commenter')->name('commenter');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
