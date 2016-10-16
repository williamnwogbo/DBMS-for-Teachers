<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSchoolCordinationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('school_cordinations', function(Blueprint $table)
		{
			$table->foreign('subject_id', 'fk_school_cordinations_1')->references('id')->on('subjects')->onUpdate('CASCADE')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('school_cordinations', function(Blueprint $table)
		{
			$table->dropForeign('fk_school_cordinations_1');
		});
	}

}
