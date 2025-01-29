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
		Schema::create('jos1_xmap', function (Blueprint $table) {
			$table->string('name', 30);
			$table->string('value', 100)->nullable()->default(null);
		});

		Schema::table('jos1_xmap', function (Blueprint $table) {
			$table->primary('name', 'PRIMARY');
		});

	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_xmap', function (Blueprint $table) {
			$table->dropPrimary('PRIMARY');
		});

		Schema::dropIfExists('jos1_xmap');
	}
};
