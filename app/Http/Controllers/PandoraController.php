<?php namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use \GitHub;


class PandoraController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Pandora Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $latestEvents = Event::take(5)->orderBy('created_at', 'desc')->get();
        $eventsCount = Event::count(); //Events Number

        $latestUsers = User::take(8)->orderBy('created_at', 'desc')->get();
        $usersCount = User::count(); // Users Number

        $issues = GitHub::issues()->all('WillyReyno', 'japanin', array('state' => 'all'));
        //$json_issues = json_encode($issues);

        $vars = ['eventsCount', 'usersCount', 'latestEvents', 'latestUsers', 'issues'];
        return view('pandora.index', compact($vars));
    }

}
