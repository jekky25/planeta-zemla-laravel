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
		Schema::create('jos1_poll_data', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->integer('pollid')->default(0);
			$table->text('text');
			$table->integer('hits')->default(0);
		});

		Schema::table('jos1_poll_data', function (Blueprint $table) {
			$table->index('pollid', 'pollid');
		});

	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_poll_data', function (Blueprint $table) {
			$table->dropIndex('pollid');
		});

		Schema::dropIfExists('jos1_poll_data');
	}
};
