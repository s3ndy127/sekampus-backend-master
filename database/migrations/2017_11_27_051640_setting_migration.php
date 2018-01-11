<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SettingMigration extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('setting', function (Blueprint $table) {
			$table->increments('id');
			$table->string('nomor_rekening')->nullable();
			$table->integer('price');
			$table->integer('distance');
			$table->boolean('isFlat');
			$table->timeStamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('setting');
	}
}
