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
		Schema::create('jos1_migration_backlinks', function (Blueprint $table) {
			$table->integer('itemid')->default(0);
			$table->string('name', 100);
			$table->text('url');
			$table->text('sefurl');
			$table->text('newurl');
		});

		Schema::table('jos1_migration_backlinks', function (Blueprint $table) {
			$table->primary('itemid', 'PRIMARY');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_migration_backlinks', function (Blueprint $table) {
			$table->dropPrimary('PRIMARY');
		});

		Schema::dropIfExists('jos1_migration_backlinks');
	}
};
