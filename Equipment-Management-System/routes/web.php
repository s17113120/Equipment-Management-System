<?php

use GuzzleHttp\Psr7\Request;
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


    Route::group(['prefix' => 'devices'], function ($data) {
        Route::get('/', 'DeviceController@index');
        Route::get('/search/{data}', 'DeviceController@search');
        Route::get('/create', 'DeviceController@create');
        Route::post('/store', 'DeviceController@store');

    });

    Route::group(['prefix' => 'records'], function () {
        Route::post('/store','RecordController@store');
        Route::get('/create', 'RecordController@create');
        Route::get('/searchLend', 'RecordController@searchLend');
        Route::get('/searchLendHistory', 'RecordController@searchLendHistory');
        Route::get('/checkLend', 'RecordController@checkLend');
        Route::post('/updateLend', 'RecordController@updateLend');
        Route::get('/lendHistory', 'RecordController@lendHistory');
        Route::get('/search/{data}', 'RecordController@search');
    });



    Route::resource('posts', 'UserPostsController');
    Route::get('/home', 'HomeController@index')->name('home');

