<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
			$table->integer('id', true);
			$table->string('facebook_id', 191)->nullable();
			$table->string('name', 50);
			$table->string('lastname', 50)->nullable();
			$table->string('email', 50)->nullable();
			$table->string('password', 191);
			$table->string('image', 100)->nullable()->default('defaultprofile.jpg');
			$table->string('role', 10)->nullable();
			$table->string('remember_token', 100)->nullable();
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
