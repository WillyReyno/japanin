<?php namespace App;

use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Contracts\Factory as Socialite;
use App\Repositories\UserRepository;
use Request;


class AuthenticateUser {
    private $socialite;
    private $auth;
    private $users;

    public function __construct(Socialite $socialite, Guard $auth, UserRepository $users) {
        $this->socialite = $socialite;
        $this->users = $users;
        $this->auth = $auth;
    }

    public function execute($request, $listener, $provider) {

        // Check if we receive an oauth token from a social media provider
        if (!$request) return $this->getAuthorizationFirst($provider);

        $mail = $this->getSocialUser($provider)->getEmail();
        if($mail) {
            $userTest = User::where('email', '=', $mail)->first();

            if($userTest) {
                return Redirect::to('auth/login')->withErrors('Cette adresse e-mail est déjà utilisée.');
            }
        }


        // Get the user information
        $user = $this->users->findByUserNameOrCreate($this->getSocialUser($provider));

        $this->auth->login($user, true);

        return $listener->userHasLoggedIn($user);
    }

    private function getAuthorizationFirst($provider) {
        return $this->socialite->driver($provider)->redirect();
    }

    private function getSocialUser($provider) {
        return $this->socialite->driver($provider)->user();
    }
}