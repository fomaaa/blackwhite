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


/* ================== Homepage + Admin Routes ================== */

require __DIR__.'/admin_routes.php';

Route::auth();

Route::group(['middleware' => ['guest']], function () {
	Route::get('/', 'HomeController@login');
});


Route::group(['middleware' => ['clients']], function () {
	Route::get('/home', 'HomeController@index');
	Route::get('/check', 'HomeController@check');
	Route::get('/add', 'HomeController@add');
	Route::get('/add/black', 'HomeController@black');
	Route::get('/add/white', 'HomeController@white');
	Route::post('/add/white', 'HomeController@whiteAdd');
	Route::post('/add/black', 'HomeController@blackAdd');
	Route::get('/client/{id}', 'HomeController@clients');

	//AJAX
	Route::post('/checkbyphone', 'HomeController@checkByPhone');
	Route::post('/checkbyemail', 'HomeController@checkByEmail');
	Route::post('/addcomment', 'HomeController@addComment');
	Route::post('/editpersonalstatus', 'HomeController@editStatus');

});

