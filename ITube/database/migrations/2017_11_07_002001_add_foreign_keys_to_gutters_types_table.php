<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGuttersTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('gutters_types', function(Blueprint $table)
		{
			$table->foreign('user_id', 'fk_gutters_types_users')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('gutters_types', function(Blueprint $table)
		{
			$table->dropForeign('fk_gutters_types_users');
		});
	}

}
