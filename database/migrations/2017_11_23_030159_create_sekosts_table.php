<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSekostsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('sekost', function (Blueprint $table) {
			$table->increments('id');
			$table->string('nama_kos')->nullable();
			$table->string('nama_pemilik')->nullable();
			$table->string('nama_penjaga')->nullable();
			$table->string('telp_pemilik')->nullable();
			$table->string('telp_penjaga')->nullable();
			$table->text('alamat')->nullable();
			$table->string('latitude')->nullable();
			$table->string('longitude')->nullable();
			$table->time('waktu_buka')->nullable();
			$table->time('waktu_tutup')->nullable();
			$table->integer('price')->nullable();
			$table->string('mode_pembayaran')->nullable();
			$table->text('fasilitas_umum')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('sekost');
	}
}
