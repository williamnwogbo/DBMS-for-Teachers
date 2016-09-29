<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSchoolCordinationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('school_cordinations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('state_id')->nullable()->index('fk_school_cordinations_2_idx');
			$table->integer('subject_id')->nullable()->index('fk_school_cordinations_1_idx');
			$table->integer('teacher_id')->nullable()->index('fk_school_cordinations_2_idx1');
			$table->text('school', 65535)->nullable();
			$table->date('from')->nullable();
			$table->date('to')->nullable();
			$table->string('designation')->nullable();
			$table->string('grade_level')->nullable();
			$table->enum('uploaded', array('0','1'))->nullable();
			$table->integer('online_id')->nullable();
			$table->string('email')->nullable();
			$table->enum('current', array('0','1'))->nullable();
			$table->text('class', 65535)->nullable();
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
		Schema::drop('school_cordinations');
	}

}
