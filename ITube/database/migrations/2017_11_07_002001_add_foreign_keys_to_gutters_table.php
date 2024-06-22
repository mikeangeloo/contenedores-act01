<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGuttersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('gutters', function(Blueprint $table)
		{
			$table->foreign('gutters_types_id', 'fk_gutters_gutters_types')->references('id')->on('gutters_types')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('gutters', function(Blueprint $table)
		{
			$table->dropForeign('fk_gutters_gutters_types');
		});
	}

}
