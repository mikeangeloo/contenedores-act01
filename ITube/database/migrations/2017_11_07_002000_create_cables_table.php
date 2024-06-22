<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cables', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cables_types_id')->index('fk_cables_cables_types');
			$table->string('description', 100)->nullable();
			$table->float('external_diameter', 5)->unsigned()->nullable();
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
		Schema::drop('cables');
	}

}
