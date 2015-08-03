<?php namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function findByUserNameOrCreate($userData, $provider) {

        if(isset($userData->user['gender'])) {
            $sex = $userData->user['gender'];
        } else {
            $sex = null;
        }

        $user = User::where('provider_id', '=', $userData->id)->first();
        if(!$user) {
            $user = User::create([
                'provider_id' => $userData->id,
                'provider' => $provider,
                'username' => $userData->name,
                'email' => $userData->email,
                'avatar' => $userData->avatar,
                'sex' => $sex,
                'active' => 1,
            ]);

            $user->attachRole(2);
        }

        $this->checkIfUserNeedsUpdating($userData, $user);
        return $user;
    }

    public function checkIfUserNeedsUpdating($userData, $user) {
        $socialData = [
            'avatar' => $userData->avatar,
            'email' => $userData->email,
            'username' => $userData->name,
        ];

        $dbData = [
            'avatar' => $user->avatar,
            'email' => $user->email,
            'username' => $user->username,
        ];

        if(!empty(array_diff($socialData, $dbData))) {
            $user->username = $userData->name;
            $user->avatar = $userData->avatar;
            $user->email = $userData->email;
            $user->save();
        }
    }
}