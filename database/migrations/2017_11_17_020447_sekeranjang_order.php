<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SekeranjangOrder extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('sekeranjang_order', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('item_id')->unsigned();
			$table->integer('merchant_id')->unsigned();
			$table->string('nama_penerima')->nullable();
			$table->string('telp_penerima')->nullable();
			$table->string('catatan_penerima')->nullable();
			$table->text('alamat')->nullable();
			$table->string('catatan_lokasi')->nullable();
			$table->date('tanggal_kirim')->nullable();
			$table->string('latitude')->nullable();
			$table->string('longitude')->nullable();
			$table->dateTime('waktu_cod')->nullable();
			$table->string('tipe_pembayaran')->nullable();
			$table->integer('price')->nullable();
			$table->string('nama_item')->nullable();
			$table->string('invoice_type')->nullable();
			$table->string('service_type')->nullable();
			$table->string('merchant_owner')->nullable();
			$table->text('merchant_address')->nullable();
			$table->string('merchant_phone')->nullable();
			//
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('sekeranjang_order');
	}
}
