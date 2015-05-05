<?php

use Bican\Roles\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Bican\Roles\Models\Permission;
use App\Models\User;

class PermissionTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();

        $test = Permission::create([
            'name' => 'Edit Event',
            'slug' => 'edit.event',
            'model' => 'App\Models\Event'
        ]);

        $secondtest = Permission::create([
            'name' => 'Delete Event',
            'slug' => 'delete.event',
            'model' => 'App\Models\Event'
        ]);

        Role::find(1)->attachPermission($test);
        Role::find(1)->attachPermission($secondtest);
    }

}
