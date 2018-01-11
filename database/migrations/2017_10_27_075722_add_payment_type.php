<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddPaymentType extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('freemeal_order', function ($table) {
			$table->string('payment_type')->nullable()->default('transfer');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('freemeal_order', function ($table) {
			$table->dropColumn('payment_type');
		});
	}
}
