<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProfessionalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('professionals', function(Blueprint $table)
		{
			$table->foreign('subject_id', 'fk_professionals_1')->references('id')->on('subjects')->onUpdate('CASCADE')->onDelete('NO ACTION');
			$table->foreign('teacher_id', 'fk_professionals_2')->references('id')->on('teachers')->onUpdate('CASCADE')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('professionals', function(Blueprint $table)
		{
			$table->dropForeign('fk_professionals_1');
			$table->dropForeign('fk_professionals_2');
		});
	}

}
