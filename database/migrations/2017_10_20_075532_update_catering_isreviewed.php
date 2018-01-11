<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class UpdateCateringIsreviewed extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('catering_order', function ($table) {
			$table->boolean('is_reviewed')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('catering_order', function ($table) {
			$table->dropColumn('is_reviewed');
		});
	}
}