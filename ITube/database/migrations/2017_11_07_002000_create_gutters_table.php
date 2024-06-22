<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGuttersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gutters', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('gutters_types_id')->index('fk_gutters_gutters_types');
			$table->float('width', 5)->unsigned()->nullable();
			$table->float('high', 5)->unsigned()->nullable();
			$table->string('description', 100)->nullable();
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
		Schema::drop('gutters');
	}

}
