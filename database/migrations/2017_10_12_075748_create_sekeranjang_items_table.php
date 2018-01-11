<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSekeranjangItemsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('sekeranjang_items', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('merchant_id')->unsigned();
			$table->string('name_merchant')->nullable();
			$table->string('name')->nullable();
			$table->string('type')->nullable();
			$table->string('kategori')->nullable();
			$table->integer('price')->nullable();
			$table->string('image')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('sekeranjang_items');
	}
}
