<?php namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Laravel\Socialite\Contracts\Factory as Socialite;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Redirect;

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
    public function __construct(Socialite $socialite, Guard $auth, UserRepository $users)
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->socialite = $socialite;
        $this->users = $users;
        $this->auth = $auth;
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

        $new_user->attachRole(2);

        return $new_user;
    }

    public function getSocialAuth($provider=null)
    {
        if(!config("services.$provider")) abort('404'); //just to handle providers that doesn't exist

        return $this->socialite->with($provider)->redirect();
    }


    public function getSocialAuthCallback($provider=null)
    {
        if($user = $this->socialite->with($provider)->user()){
            $mail = $user->email;

            if($mail) {

                // Check if there is a user with the same email from a different provider
                $userTest = User::where('email', '=', $mail)
                    ->where('provider', '<>', $provider)
                    ->first();

                // Then redirects with error
                if($userTest) {
                    return Redirect::to('auth/login')->withErrors('Cette adresse e-mail est déjà utilisée.');
                }
            }

            // Get the user information
            $current_user = $this->users->findByUserNameOrCreate($user, $provider);

            $this->auth->login($current_user, true);

            return redirect('/');

        } else {
            return Redirect::to('auth/login')
                ->withErrors('Un problème est survenu si cela se reproduit, veuillez contacter un administrateur.');
        }
    }
}
