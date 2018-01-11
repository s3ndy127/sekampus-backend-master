<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddImageColumnMenu extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('catering_menu', function ($table) {
			$table->string('image')->nullable()->after('malam');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('catering_menu', function ($table) {
			$table->dropColumn('image');
		});
	}
}
