<?php

use App\Models\Event;
use Bican\Roles\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Bican\Roles\Models\Permission;
use App\Models\User;

class EventTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->delete();

        Event::create([
            'name' => 'Event 1',
            'type_id' => 1,
            'address' => '13 rue des périchaux, 75015 Paris',
            'start_date' => '2015-06-01',
            'end_date' => '2015-06-29',
            'description' => 'blabla',
            'user_id' => 1,
            'private' => false,
            'active' => true
        ]);

        Event::create([
            'name' => 'Event 2',
            'type_id' => 1,
            'address' => '13 rue des périchaux, 75015 Paris',
            'start_date' => '2015-06-01',
            'end_date' => '2015-06-29',
            'description' => 'blabla',
            'user_id' => 2,
            'private' => false,
            'active' => true
        ]);

    }

}
