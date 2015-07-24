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

use App\Models\Oldslug;
use App\Models\UsersOldslug;
use App\Models\Event;
use App\Models\User;

// Fourni un objet aux méthodes du controller plutôt qu'un id
Route::model('event', 'Event');
Route::model('user', 'User');


// Index
Route::get('/', 'HomeController@index');

Route::bind('event', function($slug) {
    $oldSlug = Oldslug::whereSlug($slug)->first();
    if (is_null($oldSlug)) {
        return Event::whereSlug($slug)->first();
    } else {
        return $slug;
    }
});

Route::bind('user', function($slug) {
   $userOldSlug = UsersOldslug::whereSlug($slug)->first();
    if(is_null($userOldSlug)) {
        return User::whereSlug($slug)->first();
    } else {
        return $slug;
    }
});

Route::resource('event', 'EventController');

Route::resource('user', 'UserController');

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
