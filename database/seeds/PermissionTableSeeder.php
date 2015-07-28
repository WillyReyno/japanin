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

//        $editEvent = Permission::create([
//            'name' => 'Edit Event',
//            'slug' => 'edit.event',
//            'model' => 'App\Models\Event'
//        ]);
//
//
//
//        $deleteEvent = Permission::create([
//            'name' => 'Delete Event',
//            'slug' => 'delete.event',
//            'model' => 'App\Models\Event'
//        ]);
//
//        Role::find(1)->attachPermission($editEvent);
//        Role::find(1)->attachPermission($deleteEvent);
//
//
//
//        $editUser = Permission::create([
//            'name' => 'Edit User',
//            'slug' => 'edit.user',
//            'model' => 'App\Models\User'
//        ]);
//
//        Role::find(2)->attachPermission($editUser);

    }

}
