<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCampusTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('campus', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->text('address');
			$table->string('image')->nullable();
			$table->string('latitude')->nullable();
			$table->string('longitude')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('campus');
	}
}
