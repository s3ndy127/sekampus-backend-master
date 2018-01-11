<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class UpdateFoodStatusTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('food', function ($table) {
			$table->boolean('pagi')->after('image')->default(false);
			$table->boolean('siang')->after('pagi')->default(false);
			$table->boolean('malam')->after('siang')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('food', function ($table) {
			$table->dropColumn('pagi');
			$table->dropColumn('siang');
			$table->dropColumn('malam');
		});
	}
}
