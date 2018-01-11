<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FreemealItems extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('freemeal_items', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('order_id')->unsigned();
			$table->integer('food_id')->unsigned();
			$table->integer('merchant_id')->unsigned();
			$table->string('nama_makanan')->nullable();
			$table->integer('price')->nullable();
			$table->date('waktu_kirim')->nullable();
			$table->string('merchant_owner')->nullable();
			$table->string('merchant_name')->nullable();
			$table->text('merchant_address')->nullable();
			$table->string('merchant_phone')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('freemeal_items');
	}
}
