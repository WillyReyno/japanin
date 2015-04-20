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


// Index
Route::get('/', 'HomeController@index');


// Evènements
Route::resource('event', 'EventController');

Route::bind('event', function($value, $route) {
    return \App\Models\Event::whereSlug($value)->first();
});

// Uploads fichiers

//Route::get('fileentry', 'FileEntryController@index');
Route::get('fileentry/get/{filename}', [
    'as' => 'getentry',
    'uses' => 'FileEntryController@get']);

//Route::post('fileentry/add', [
//    'as' => 'addentry',
//    'uses' => 'FileEntryController@add']);



Route::group(['prefix' => 'admin'], function() {
    // Todo Admin Routes
});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
