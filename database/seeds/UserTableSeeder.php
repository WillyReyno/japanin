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
            'username' => 'WillyReyno',
            'email' => 'reyno.willy@gmail.com',
            'password' => bcrypt('drtest12'),
            'birth' => '1993-07-12',
            'sex' => 'man'
        ]);
        $firstUser->attachRole(1);

        $secondUser = User::create([
            'username' => 'Angy',
            'email' => 'angy.exicut@gmail.com',
            'password' => bcrypt('drtest12'),
            'birth' => '1993-07-12',
            'sex' => 'man'
        ]);
        $secondUser->attachRole(2);

    }

}
