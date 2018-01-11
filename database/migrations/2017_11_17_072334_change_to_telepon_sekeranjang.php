<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class ChangeToTeleponSekeranjang extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('sekeranjang_order', function ($table) {
			$table->renameColumn('telp_penerima', 'telepon_penerima');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('sekeranjang_order', function ($table) {
			$table->renameColumn('telepon_penerima', 'telp_penerima');
		});
	}
}
