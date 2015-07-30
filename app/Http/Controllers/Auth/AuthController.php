<?php namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\AuthenticateUser;
use Illuminate\Http\Request;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
	public function __construct()
	{
		$this->middleware('guest', ['except' => 'getLogout']);
	}

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255', //TODO Unique ou non ? Checker dans les oldslugs ?
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'birth' => 'date',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function create(array $data)
    {
        $new_user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        User::find($new_user['id'])->attachRole(2);

        return $new_user;
    }

    public function login(AuthenticateUser $authenticateUser, Request $request, $provider = null) {
        return $authenticateUser->execute($request->all(), $this, $provider);
    }

    public function userHasLoggedIn($user) {
        \Session::flash('message', 'Bienvenue, '.$user->username);
        return redirect('/');
    }
}
