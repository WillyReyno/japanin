<?php namespace App\Repositories;

use App\Models\User;
class UserRepository
{
    public function findByUserNameOrCreate($userData) {
        $user = User::where('provider_id', '=', $userData->id)->first();

        if(!$user) {
            $user = User::create([
                'provider_id' => $userData->id,
                'username' => $userData->name,
                'email' => $userData->email,
                'avatar' => $userData->avatar,
                'active' => 1,
            ]);
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