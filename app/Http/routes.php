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

Route::get('/', ['uses' => 'HomeController@index']);
/*
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
*/

Route::get('/home', ['uses' => 'HomeController@index']);

Route::get('/introduce', ['uses' => 'HomeController@introduce']);

Route::get('/manual', ['uses' => 'HomeController@manual']);

Route::get('/login', ['uses' => 'Auth\AuthController@login', 'middleware' => ['guest']]);

Route::post('/login', ['uses' => 'Auth\AuthController@authenticate', 'middleware' => ['guest']]);

Route::get('/logout', ['uses' => 'Auth\AuthController@logout', 'middleware' => ['auth']]);

Route::get('/user', ['uses' => 'UserController@index', 'middleware' => ['auth']]);

Route::post('/user',['uses' => 'UserController@create_folder', 'middleware' => ['auth']]);

Route::get('/folder',['uses' => 'FolderController@index', 'middleware' => ['auth']]);

Route::post('/folder',['as' => 'add.folder','uses' => 'FolderController@create_folder', 'middleware' => ['auth']]);

Route::post('/file/upload',['as' => 'upload.to.file', 'uses' => 'FileController@uploadQuestion', 'middleware' => ['auth']]);

Route::post('/folder/mix',['as' => 'mix.to.folder', 'uses' => 'FileController@mixQuestion', 'middleware' => ['auth']]);

Route::get('/file',['uses' => 'FileController@index', 'middleware' => ['auth']]);

Route::post('/file',['as' => 'add.file','uses' => 'FileController@create_file', 'middleware' => ['auth']]);

Route::get('/group',['uses' => 'GroupController@index', 'middleware' => ['auth']]);

Route::get('/test', ['uses' => 'TestController@index', 'middleware' => ['auth']]);

Route::post('/test', ['uses' => 'TestController@download_test', 'middleware' => ['auth']]);

Route::get('/answer', ['uses' => 'TestController@answers', 'middleware' => ['auth']]);

Route::get('/register', ['uses' => 'RegisterController@index', 'middleware' => ['guest']]);

Route::post('/register', ['uses' => 'RegisterController@creat_account', 'middleware' => ['guest']]);