<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFreemealOrder extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('freemeal_order', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('merchant_id')->unsigned();
			$table->integer('campus_id')->unsigned();
			$table->string('invoice')->nullable();
			$table->string('nama_penerima');
			$table->string('telepon_penerima')->nullable();
			$table->text('alamat_penerima');
			$table->text('catatan_penerima');
			$table->string('latitude');
			$table->string('longitude');
			$table->date('tanggal_kirim');
			$table->integer('price');
			$table->string('nama_kampus');
			$table->text('catatan_makanan');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('freemeal_order');
	}
}
