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
    Route::get('article/create', 'Admin\ArticleController@add')->name('Newarticle');
    Route::post('article/create', 'Admin\ArticleController@create');
    Route::get('article', 'Admin\ArticleController@index')->name('Newindex');
    Route::get('article/edit', 'Admin\ArticleController@edit');
    Route::post('article/edit', 'Admin\ArticleController@update');
    Route::get('article/delete', 'Admin\ArticleController@delete');
    Route::get('article/index', 'Admin\CommentController@add');
    Route::post('article/comment', 'Admin\CommentController@create');
});


Route::get('/', 'ArticleController@index');
Auth::routes();

Route::resource('comment', 'CommentController', ['only' => ['']]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/beachcombing', 'HomeController@beachcombing')->name('beachcombing');

Route::get('/shoreplay', 'HomeController@shoreplay')->name('shoreplay');

