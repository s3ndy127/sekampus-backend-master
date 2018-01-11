<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class UpdateTipeInvoiceStatus extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('freemeal_order', function ($table) {
			$table->integer('campus_id')->unsigned()->after('user_id');
		});

		Schema::table('history', function ($table) {
			$table->string('tipe_invoice')->nullable()->after('tipe_layanan');
		});

		Schema::table('payment_confirmations', function ($table) {
			$table->integer('status')->default(0)->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		//
	}
}
