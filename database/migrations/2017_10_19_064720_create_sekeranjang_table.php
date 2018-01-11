<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSekeranjangTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('sekeranjang', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('merchant_id')->unsigned();
			$table->string('nama_barang')->nullable();
			$table->string('kategori')->nullable();
			$table->integer('price')->default(0);
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
		Schema::dropIfExists('sekeranjang');
	}
}
