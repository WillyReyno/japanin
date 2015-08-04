<?php namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Laravel\Socialite\Contracts\Factory as Socialite;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

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


    protected $redirectTo = '';

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
            'username' => 'required|max:255',
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

    /**
     * Override to redirect to the previous url
     * Original : vendor/laravel/framework/src/Illuminate/Foundation/Auth/AuthenticatesUsers.php
     **/
    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::user());
        }
        return Redirect::back();
    }

    /**
     * Override function to log with username instead of email
     * Original : vendor/laravel/framework/src/Illuminate/Foundation/Auth/AuthenticatesUsers.php
     *
     * @param Request $request
     * @return mixed
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only('username', 'remember'))
            ->withErrors([
                'username' => 'Les identifiants ne sont pas corrects.',
            ]);
    }

    /**
     * Override postRegister to change redirect url
     * Original : vendor/laravel/framework/src/Illuminate/Foundation/Auth/RegistersUsers.php
     *
     * @param Request $request
     * @return Redirect
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        Auth::login($this->create($request->all()));

        return Redirect::back();
    }

    /**
     * Override getLogout to change redirect after
     * @return Redirect
     */
    public function getLogout()
    {
        Auth::logout();

        return Redirect::back();
    }

    /**
     * @param null $provider
     * @return mixed
     */
    public function getSocialAuth($provider=null)
    {
        if(!config("services.$provider")) abort('404'); //just to handle providers that doesn't exist

        return $this->socialite->with($provider)->redirect();
    }


    /**
     * @param null $provider
     * @return mixed
     */
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

            return Redirect::back();

        } else {
            return Redirect::to('auth/login')
                ->withErrors('Un problème est survenu si cela se reproduit, veuillez contacter un administrateur.');
        }
    }
}
