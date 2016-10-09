<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeachersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teachers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('surname')->nullable();
			$table->string('othernames')->nullable();
			$table->string('title')->nullable();
			$table->string('tsc_file_no', 20)->nullable();
			$table->string('og_file_no', 20)->nullable();
			$table->date('date_of_birth')->nullable();
			$table->string('email')->nullable();
			$table->string('phone_no', 20)->nullable();
			$table->integer('nationality')->nullable();
			$table->integer('state_id')->nullable()->index('fk_teachers_1_idx');
			$table->integer('local_govt_id')->nullable()->index('fk_teachers_1_idx1');
			$table->string('ward')->nullable();
			$table->enum('professional_status', array('0','1'))->nullable();
			$table->timestamps();
			$table->integer('online_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('teachers');
	}

}
