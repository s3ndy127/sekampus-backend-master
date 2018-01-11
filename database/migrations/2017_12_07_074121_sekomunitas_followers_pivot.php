<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SekomunitasFollowersPivot extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('followers_sekomunitas', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('komunitas_id')->unsigned();

			$table->foreign('user_id')->references('id')->on('users')
				->onDelete('cascade');

			$table->foreign('komunitas_id')->references('id')->on('komunitas')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('followers_sekomunitas');
	}
}
