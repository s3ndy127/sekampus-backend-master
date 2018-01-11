<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class UpdateIsReviewed extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('freemeal_order', function ($table) {
			$table->boolean('is_reviewed')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('freemeal_order', function ($table) {
			$table->dropColumn('is_reviewed');
		});
	}
}
