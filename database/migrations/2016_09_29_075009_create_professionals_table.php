<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProfessionalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('professionals', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('qualification', 65535)->nullable();
			$table->string('year', 6)->nullable();
			$table->string('subject_of_specialisation')->nullable();
			$table->integer('subject_id')->nullable()->index('fk_professionals_1_idx');
			$table->enum('classifications', array('1','2'))->nullable();
			$table->string('post_held', 45)->nullable();
			$table->string('retirement', 45)->nullable();
			$table->date('appointment')->nullable();
			$table->date('last_promotion')->nullable();
			$table->integer('teacher_id')->nullable()->index('fk_professionals_2_idx');
			$table->timestamps();
			$table->enum('uploaded', array('0','1'))->nullable();
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
		Schema::drop('professionals');
	}

}
