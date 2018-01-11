<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class IsReviewedSekeranjang extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('sekeranjang_order', function ($table) {
			$table->boolean('is_reviewed')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('sekeranjang_order', function ($table) {
			$table->dropColumn('is_reviewed');
		});
	}
}
