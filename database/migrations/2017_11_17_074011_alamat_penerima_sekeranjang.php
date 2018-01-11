<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AlamatPenerimaSekeranjang extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('sekeranjang_order', function ($table) {
			$table->renameColumn('alamat', 'alamat_penerima');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('sekeranjang_order', function ($table) {
			$table->renameColumn('alamat_penerima', 'alamat');
		});

	}
}
