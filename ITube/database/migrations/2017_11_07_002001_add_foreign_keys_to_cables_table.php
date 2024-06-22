<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cables', function(Blueprint $table)
		{
			$table->foreign('cables_types_id', 'fk_cables_cables_types')->references('id')->on('cables_types')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cables', function(Blueprint $table)
		{
			$table->dropForeign('fk_cables_cables_types');
		});
	}

}
