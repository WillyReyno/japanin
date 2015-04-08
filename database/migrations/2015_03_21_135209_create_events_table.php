<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->integer('type_id')->unsigned();
            $table->string('address');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->date('start_date');
            $table->date('end_date');
            $table->text('description');
            $table->integer('poster_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->boolean('private')->default(false);
            $table->boolean('active')->default(false);
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('poster_id')->references('id')->on('fileentries');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }

}
