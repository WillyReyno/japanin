<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Bican\Roles\Models\Role;
use App\Models\User;

class RoleTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        Role::create([
            'name' => 'Administrateur',
            'slug' => 'admin',
            'level' => '10',
            'description' => ''
        ]);

        Role::create([
            'name' => 'Membre',
            'slug' => 'member',
            'level' => '1',
            'description' => ''
        ]);

    }

}
