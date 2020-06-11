<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/',  'PagesController@index');
Route::get('home', 'PagesController@index');
Route::get('login', 'PagesController@login');
Route::get('addUser', 'PagesController@addUser');


Route::post('user/store', 'UserPostsController@store');
Route::post('user/login', 'UserPostsController@login');
Route::get('logout', 'UserPostsController@logout');




// Route::get('posts', 'PagesController@index');


Route::resource('devices', 'DeviceController');
Route::get('devices/create', 'DeviceController@create');
// Route::post('posts/home',  'DeviceController@index');
// Route::get('posts/lend', 'DeviceController@lend');

// Route::resource('records', 'RecordController');
Route::get('records/create', 'RecordController@create');
Route::get('records/searchLend', 'RecordController@searchLend');
Route::get('records/checkLend', 'RecordController@checkLend');







Route::resource('posts', 'UserPostsController');

// Route::post('posts/checkUsers','UserPostsController@index');
// Route::post('posts/createDevive','UserPostsController@index');
// Route::post('posts/searchDevice','UserPostsController@index');
// Route::post('posts/createForm','UserPostsController@index');

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
