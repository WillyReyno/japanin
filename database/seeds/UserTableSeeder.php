<?php

use Bican\Roles\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Bican\Roles\Models\Permission;
use App\Models\User;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $firstUser = User::create([
            'username' => 'test1',
            'email' => 'test1@test.fr',
            'password' => bcrypt('drtest12'),
            'birth' => '1993-07-12',
            'sex' => 'man'
        ]);
        $firstUser->attachRole(2);

        $secondUser = User::create([
            'username' => 'test2',
            'email' => 'test2@test.fr',
            'password' => bcrypt('drtest12'),
            'birth' => '1993-07-12',
            'sex' => 'man'
        ]);
        $secondUser->attachRole(2);

    }

}
