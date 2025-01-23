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
		Schema::create('jos1_jcomments_version', function (Blueprint $table) {
			$table->string('version', 16);
			$table->string('previous', 16);
			$table->dateTime('installed');
			$table->dateTime('updated');
		});

		Schema::table('jos1_jcomments_version', function (Blueprint $table) {
			$table->primary('version', 'PRIMARY');
		});

	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_jcomments_version', function (Blueprint $table) {
			$table->dropPrimary('PRIMARY');
		});
		Schema::dropIfExists('jos1_jcomments_version');
	}
};
