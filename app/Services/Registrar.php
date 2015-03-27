<?php namespace App\Services;

use App\Models\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

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
            'birth' => 'required|date'
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
			'password' => bcrypt($data['password']),
            'birth' => $data['birth']
		]);

        User::find($new_user['id'])->attachRole(2);

        return $new_user;
	}

}
