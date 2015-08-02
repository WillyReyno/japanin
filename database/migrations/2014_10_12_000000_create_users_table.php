<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username')->nullable();
			$table->string('slug')->unique()->nullable();
			$table->string('email')->unique()->nullable();
			$table->string('password', 60);
            $table->string('avatar');
            $table->date('birth');
            $table->string('sex');
            $table->boolean('active')->default(true);
			$table->string('provider');
			$table->string('provider_id')->unique();
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('users');
	}

}
