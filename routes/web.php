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

// Route::get('/', function () {
//      return view('welcome');
//  });

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('seanews/create', 'Admin\SeanewsController@add')->name('Newseanews');
    Route::post('seanews/create', 'Admin\SeanewsController@create');
    Route::get('seanews', 'Admin\SeanewsController@index')->name('Newindex');
    Route::get('seanews/edit', 'Admin\SeanewsController@edit');
    Route::post('seanews/edit', 'Admin\SeanewsController@update');
    Route::get('seanews/delete', 'Admin\SeanewsController@delete');
});

Route::get('/', 'SeanewsController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/beachcombing', 'HomeController@beachcombing')->name('beachcombing');

Route::get('/shoreplay', 'HomeController@shoreplay')->name('shoreplay');

