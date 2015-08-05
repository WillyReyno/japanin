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

use App\Models\UsersOldslug;
use App\Models\Event;
use App\Models\User;

// Fourni un objet aux méthodes du controller plutôt qu'un id
//Route::model('event', 'Event');
Route::model('user', 'User');


// Index
Route::get('/', 'HomeController@index');

/* Authentification  */
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


/* Facebook, Twitter and Google Route  */
Route::get('/login/{provider?}',[
    'uses' => 'Auth\AuthController@getSocialAuth',
    'as'   => 'auth.getSocialAuth'
]);

/* Callback route for Facebook, Twitter and Google  */
Route::get('/login/callback/{provider?}',[
    'uses' => 'Auth\AuthController@getSocialAuthCallback',
    'as'   => 'auth.getSocialAuthCallback'
]);


//
//Route::bind('event', function($slug) {
//        return $slug;
//});

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


// Route qui permet de participer ou de quitter un évènement.
Route::get('going/{event_id}', 'EventController@userGoing');


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
    Route::get('/', 'PandoraController@index');
});


/* Events  */
Route::get('{typeslug}/{slug?}/{id}', [
    'as' => 'showEvents',
    'uses' => 'EventController@show']);
Route::get('event/{id}/edit', 'EventController@edit');

