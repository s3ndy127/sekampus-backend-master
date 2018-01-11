<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CloseOpenTimeMerchant extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('merchant', function ($table) {
			$table->time('open_time')->after('subType');
			$table->time('close_time')->after('open_time');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('merchant', function ($table) {
			$table->dropColumn('open_time');
			$table->dropColumn('close_time');
		});
	}
}
