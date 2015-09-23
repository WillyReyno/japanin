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

Route::get('user/edit', ['as' => 'user.edit', 'uses' => 'UserController@edit'] );
Route::get('user/destroy', ['as' => 'user.destroy', 'uses' => 'UserController@destroy'] );


Route::resource('event', 'EventController');

Route::resource('user', 'UserController', ['except' => ['edit', 'destroy']]);

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
 * Pandora
 */

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('/', 'PandoraController@index');
    Route::resource('/event', 'PandoraEventController');
    Route::resource('/user', 'PandoraUserController');
});


/* Events  */
Route::get('{typeslug}/{slug?}/{id}', [
    'as' => 'showEvents',
    'uses' => 'EventController@show']);

Route::get('event/{id}/edit', 'EventController@edit');

