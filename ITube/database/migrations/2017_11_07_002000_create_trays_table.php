<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTraysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trays', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('trays_types_id')->index('fk_trays_trays_types');
			$table->string('description', 100)->nullable();
			$table->float('peralte', 5)->unsigned()->nullable();
			$table->float('width', 5)->unsigned()->nullable();
			$table->integer('area')->unsigned()->nullable();
			$table->float('twentyfive_area', 5)->unsigned()->nullable();
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
		Schema::drop('trays');
	}

}
