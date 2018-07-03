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

Route::get('/', 'HomeController@main')->name('main.home');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::resource('articles', 'ArticlesController', ['except' => ['show']]);
    Route::get('articles/{id}/setting', 'ArticlesController@setting')->name('articles.setting');
    
    Route::resource('users', 'UsersController');
});

Route::post('upload_artical_img','ArticlesController@upload_img');

Route::get('articles/{id}', 'ArticlesController@show')->name('articles.show');
