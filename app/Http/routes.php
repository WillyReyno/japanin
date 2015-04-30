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
use App\Models\Event;

// Fourni un objet aux méthodes du controller plutôt qu'un id
Route::model('event', 'Event');


// Index
Route::get('/', 'HomeController@index');

Route::resource('event', 'EventController');

Route::bind('event', function($value, $route) {
    // TODO 301 Redirect not working
    $oldslug = Oldslug::whereSlug($value)->first();
    if($oldslug) {
        var_dump("old : ".$oldslug);
        $eventnew = Event::find($oldslug->event_id);
        var_dump("new : ".$eventnew);
        var_dump("slug : ".$eventnew->slug);
        var_dump(URL::to('event', array($eventnew->slug)));

        if ($eventnew) {
            return Redirect::to(URL::to('event', array($eventnew->slug)), 301);
        }
    } else {
        return Event::whereSlug($value)->first();
    }
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
