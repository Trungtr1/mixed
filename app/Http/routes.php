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

Route::get('/downloadmanual', ['uses' => 'HomeController@download']);

Route::get('/login', ['uses' => 'Auth\AuthController@login', 'middleware' => ['guest']]);

Route::post('/login', ['uses' => 'Auth\AuthController@authenticate', 'middleware' => ['guest']]);

Route::get('/logout', ['uses' => 'Auth\AuthController@logout', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/folder',['uses' => 'FolderController@index', 'middleware' => ['auth', 'role:1,3']]);

Route::post('/folder',['as' => 'add.folder','uses' => 'SystemController@create_folder', 'middleware' => ['auth', 'role:1,3']]);

Route::post('/group',['as' => 'add.folder.group','uses' => 'SystemController@create_folder_group', 'middleware' => ['auth', 'role:1,3']]);

Route::post('/file/upload',['as' => 'upload.to.file', 'uses' => 'FileController@uploadQuestion', 'middleware' => ['auth', 'role:1,3']]);

Route::post('/folder/mix',['as' => 'mix.to.folder', 'uses' => 'SystemController@mixQuestion', 'middleware' => ['auth', 'role:1,3']]);

Route::post('/folder/test',['as' => 'test.to.folder', 'uses' => 'SystemController@testQuestion', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/file',['uses' => 'FileController@index', 'middleware' => ['auth', 'role:1,3']]);

Route::post('/group/invite',['as' => 'invite','uses' => 'GroupController@invite', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/group/member/kick',['uses' => 'GroupController@kick_member', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/group/member/changerole',['uses' => 'GroupController@changerole', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/outgroup',['uses' => 'GroupController@out_group', 'middleware' => ['auth', 'role:1,3']]);

Route::post('/group/setting',['as' => 'groupsetting','uses' => 'GroupController@setting', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/group/member',['uses' => 'GroupController@member', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/test', ['uses' => 'TestController@index', 'middleware' => ['auth', 'role:1,3']]);

Route::post('/test', ['uses' => 'TestController@download_test', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/testing', ['uses' => 'TestController@testing']);

Route::post('/testing', ['uses' => 'TestController@nopbai']);

Route::get('/register', ['uses' => 'RegisterController@index', 'middleware' => ['guest']]);

Route::post('/register', ['uses' => 'RegisterController@creat_account', 'middleware' => ['guest']]);

Route::post('/cut',['as' => 'cut','uses' => 'SystemController@cut', 'middleware' => ['auth', 'role:1,3']]);

Route::post('/paste',['as' => 'paste','uses' => 'SystemController@paste', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/admin', ['uses' => 'AdminController@index', 'middleware' => ['auth', 'role:3']]);

Route::get('/account', ['uses' => 'UserController@account', 'middleware' => ['auth', 'role:1,3']]);

Route::post('/account', ['as' => 'edit.account', 'uses' => 'UserController@editaccount', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/bai-kiem-tra', ['uses' => 'UserController@baikiemtra', 'middleware' => ['auth', 'role:1,3']]);

Route::post('/bai-kiem-tra', ['uses' => 'UserController@sendtest', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/kho-bai-kiem-tra', ['uses' => 'UserController@storage_test', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/bai-nop', ['uses' => 'UserController@bainop', 'middleware' => ['auth', 'role:1,3']]);

Route::get('/cham-bai', ['uses' => 'TestController@chambai', 'middleware' => ['auth', 'role:1,3']]);