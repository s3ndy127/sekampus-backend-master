<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EventsSekomunitas extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('events_sekomunitas', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('komunitas_id')->unsigned();
			$table->string('name')->nullable();
			$table->text('description')->nullable();
			$table->string('image')->nullable();
			$table->timeStamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('events_sekomunitas');
	}
}
