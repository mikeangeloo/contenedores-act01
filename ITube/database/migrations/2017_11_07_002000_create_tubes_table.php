<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTubesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tubes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('tubes_types_id')->index('fk_tubes_tubes_types');
			$table->string('description', 100)->nullable();
			$table->integer('metric_designation')->unsigned()->nullable();
			$table->float('commercial_size', 5)->unsigned()->nullable();
			$table->float('inside_diameter', 5)->unsigned()->nullable();
			$table->integer('hundred_area')->unsigned()->nullable();
			$table->integer('sixty_area')->unsigned()->nullable();
			$table->integer('one_driver')->unsigned()->nullable();
			$table->integer('two_driver')->unsigned()->nullable();
			$table->integer('more_two_driver')->unsigned()->nullable();
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
		Schema::drop('tubes');
	}

}
