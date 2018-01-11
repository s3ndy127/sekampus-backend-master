<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CateringMenu extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('catering_menu', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('catering_id')->unsigned();
			$table->string('hari')->nullable();
			$table->string('pagi')->nullable();
			$table->string('siang')->nullable();
			$table->string('malam')->nullable();
			$table->timeStamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('catering_menu');
	}
}
