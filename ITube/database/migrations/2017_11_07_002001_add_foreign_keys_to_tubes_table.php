<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTubesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tubes', function(Blueprint $table)
		{
			$table->foreign('tubes_types_id', 'fk_tubes_tubes_types')->references('id')->on('tubes_types')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tubes', function(Blueprint $table)
		{
			$table->dropForeign('fk_tubes_tubes_types');
		});
	}

}
