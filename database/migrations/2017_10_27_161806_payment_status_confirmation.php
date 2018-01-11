<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class PaymentStatusConfirmation extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('payment_confirmations', function ($table) {
			$table->string('payment_type')->nullable()->default('transfer');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('payment_confirmations', function ($table) {
			$table->dropColumn('payment_type');
		});
	}
}
