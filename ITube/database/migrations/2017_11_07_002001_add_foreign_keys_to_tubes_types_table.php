<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTubesTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tubes_types', function(Blueprint $table)
		{
			$table->foreign('user_id', 'fk_tubes_types_users')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tubes_types', function(Blueprint $table)
		{
			$table->dropForeign('fk_tubes_types_users');
		});
	}

}
