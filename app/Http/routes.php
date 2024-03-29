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

// Route qui permet de participer ou de quitter un évènement.
Route::get('going/{event_id}', 'EventController@userGoing');


Route::resource('event', 'EventController');

Route::resource('user', 'UserController');



/*
 * Upload de fichiers
 */

//Route::get('fileentry', 'FileEntryController@index');

Route::get('fileentry/get/{filename}', [
    'as' => 'getentry',
    'uses' => 'FileEntryController@get']);

/*Route::post('fileentry/add', [
    'as' => 'addentry',
    'uses' => 'FileEntryController@add']);*/

/*
 * Admin
 */

Route::group(['prefix' => 'admin'], function() {
    // Todo Admin Routes
});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

//Social Login

// Route to login user via Facebook, Google or Twitter
Route::get('/login/{provider?}',[
    'uses' => 'Auth\AuthController@getSocialAuth',
    'as'   => 'auth.getSocialAuth'
]);

// Callback route for Facebook, Google and Twitter
Route::get('/login/callback/{provider?}',[
    'uses' => 'Auth\AuthController@getSocialAuthCallback',
    'as'   => 'auth.getSocialAuthCallback'
]);


