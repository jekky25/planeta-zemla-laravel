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
		Schema::create('jos1_poll_date', function (Blueprint $table) {
			$table->bigInteger('id')->autoIncrement();
			$table->dateTime('date');
			$table->integer('vote_id')->default(0);
			$table->integer('poll_id')->default(0);
		});

		Schema::table('jos1_poll_date', function (Blueprint $table) {
			$table->index('poll_id', 'poll_id');
		});

	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_poll_date', function (Blueprint $table) {
			$table->dropIndex('poll_id');
		});

		Schema::dropIfExists('jos1_poll_date');
	}
};
