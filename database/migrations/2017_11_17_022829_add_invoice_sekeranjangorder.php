<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddInvoiceSekeranjangorder extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('sekeranjang_order', function ($table) {
			$table->string('invoice')->after('merchant_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('sekeranjang_order', function ($table) {
			$table->dropColumn('invoice');
		});
	}
}
