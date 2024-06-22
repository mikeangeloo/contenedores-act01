<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProjectsContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('projects_contents', function(Blueprint $table)
		{
			$table->foreign('cables_id', 'fk_projects_content_cables')->references('id')->on('cables')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('gutters_id', 'fk_projects_content_gutters')->references('id')->on('gutters')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('projects_id', 'fk_projects_content_projects')->references('id')->on('projects')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('trays_id', 'fk_projects_content_trays')->references('id')->on('trays')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('tubes_id', 'fk_projects_content_tubes')->references('id')->on('tubes')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('projects_contents', function(Blueprint $table)
		{
			$table->dropForeign('fk_projects_content_cables');
			$table->dropForeign('fk_projects_content_gutters');
			$table->dropForeign('fk_projects_content_projects');
			$table->dropForeign('fk_projects_content_trays');
			$table->dropForeign('fk_projects_content_tubes');
		});
	}

}
