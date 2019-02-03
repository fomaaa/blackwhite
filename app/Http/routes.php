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

	Route::get('ru', 'HomeController@setLocaleRU');
	Route::get('en', 'HomeController@setLocaleEN');

Route::group(['middleware' => ['guest']], function () {
	Route::get('/', 'HomeController@login');
	Route::get('/error', 'HomeController@error');
	Route::get('/registration', 'HomeController@registration');
	Route::post('/register_girl', 'HomeController@create_girl');
	Route::get('/restore', 'HomeController@resetPassword');
	Route::post('/restore', 'HomeController@newPassword');
	Route::get('/new-password', 'HomeController@createPassword');
	Route::post('/new-password', 'HomeController@createNewPassword');
});


Route::group(['middleware' => ['clients']], function () {
	Route::get('/', 'HomeController@index');
	Route::get('/check', 'HomeController@check');
	Route::get('/add', 'HomeController@add');
	Route::get('/add/black', 'HomeController@black');
	Route::get('/add/white', 'HomeController@white');
	Route::post('/add/white', 'HomeController@whiteAdd');
	Route::post('/add/black', 'HomeController@blackAdd');
	Route::post('/destroyReview', 'HomeController@destroyReview');
	Route::post('/destroyComment', 'HomeController@destroyComment');
	Route::get('/client/{id}', 'HomeController@clients');

	//AJAX
	Route::post('/checkbyphone', 'HomeController@checkByPhone');
	Route::post('/checkbyemail', 'HomeController@checkByEmail');
	Route::post('/addcomment', 'HomeController@addComment');
	Route::post('/editpersonalstatus', 'HomeController@editStatus');

});

