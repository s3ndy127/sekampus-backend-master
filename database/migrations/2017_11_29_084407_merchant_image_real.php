<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class MerchantImageReal extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('merchant', function ($table) {
			$table->string('image_real')->nullable()->after('image');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('merchant', function ($table) {
			$table->dropColumn('image_real');
		});
	}
}
