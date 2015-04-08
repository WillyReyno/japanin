<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Type;

class TypeTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->delete();

        Type::create([
            'name' => 'Convention',
        ]);

        Type::create([
            'name' => 'Concert',
        ]);

        Type::create([
            'name' => 'Projection',
        ]);

        Type::create([
            'name' => 'Exposition',
        ]);

        Type::create([
            'name' => 'IRL',
        ]);

        Type::create([
            'name' => 'Dédicace',
        ]);

        Type::create([
            'name' => 'Autre',
        ]);
    }

}
