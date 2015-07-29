<?php namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function findByUserNameOrCreate($userData) {
        $user = User::where('provider_id', '=', $userData->id)->first();

        if(!$user) {
            if(empty($userData->nickname)) {
                $user = User::create([
                    'provider_id' => $userData->id,
                    'name' => $userData->name,
                    'username' => $userData->name,
                    'email' => $userData->email,
                    'avatar' => $userData->avatar,
                    'active' => 1,
                ]);
            } else {
                $user = User::create([
                    'provider_id' => $userData->id,
                    'name' => $userData->name,
                    'username' => $userData->nickname,
                    'email' => $userData->email,
                    'avatar' => $userData->avatar,
                    'active' => 1,
                ]);
            }
        }

        $this->checkIfUserNeedsUpdating($userData, $user);
        return $user;
    }

    public function checkIfUserNeedsUpdating($userData, $user) {
        $socialData = [
            'avatar' => $userData->avatar,
            'email' => $userData->email,
            'name' => $userData->name,
            'username' => $userData->nickname,
        ];

        $dbData = [
            'avatar' => $user->avatar,
            'email' => $user->email,
            'name' => $user->name,
            'username' => $user->username,
        ];

        if(!empty(array_diff($socialData, $dbData))) {
            if(empty($userData->nickname)) {
                $user->username = $userData->name;
            } else {
                $user->username = $userData->nickname;
            }
            $user->avatar = $userData->avatar;
            $user->email = $userData->email;
            $user->name = $userData->name;
            $user->save();
        }
    }
}