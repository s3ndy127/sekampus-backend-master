<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMerchantTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('merchant', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('image')->nullable();
			$table->text('address')->nullable();
			$table->string('telp');
			$table->string('owner');
			$table->string('latitude')->nullable();
			$table->string('longitude')->nullable();
			$table->string('type')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('merchant');
	}
}
