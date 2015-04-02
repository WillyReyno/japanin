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

// Fourni un objet aux méthodes du controller plutôt qu'un id
Route::model('event', 'Event');


// Routes
Route::get('/', 'HomeController@index');

Route::resource('event', 'EventController');

Route::bind('event', function($value, $route) {
   return \App\Models\Event::whereSlug($value)->first();
});

//Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
