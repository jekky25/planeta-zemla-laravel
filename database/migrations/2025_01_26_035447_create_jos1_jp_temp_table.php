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
		Schema::create('jos1_jp_temp', function (Blueprint $table) {
			$table->string('key');
			$table->longText('value');
		});

		Schema::table('jos1_jp_temp', function (Blueprint $table) {
			$table->primary('key', 'PRIMARY');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_jp_temp', function (Blueprint $table) {
			$table->dropPrimary('PRIMARY');
		});

		Schema::dropIfExists('jos1_jp_temp');
	}
};
