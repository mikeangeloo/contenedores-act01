<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTraysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('trays', function(Blueprint $table)
		{
			$table->foreign('trays_types_id', 'fk_trays_trays_types')->references('id')->on('trays_types')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('trays', function(Blueprint $table)
		{
			$table->dropForeign('fk_trays_trays_types');
		});
	}

}
