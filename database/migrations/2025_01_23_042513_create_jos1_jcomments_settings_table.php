<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('jos1_jcomments_settings', function (Blueprint $table) {
			$table->string('component', 50);
			$table->string('lang', 20);
			$table->string('name', 50);
			$table->text('value');
		});

		Schema::table('jos1_jcomments_settings', function (Blueprint $table) {
			$table->primary(['component', 'lang', 'name'], 'PRIMARY');
		});

	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_jcomments_settings', function (Blueprint $table) {
			$table->dropPrimary('PRIMARY');
		});
		Schema::dropIfExists('jos1_jcomments_settings');
	}
};
