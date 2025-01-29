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
		Schema::create('jos1_stats_agents', function (Blueprint $table) {
			$table->string('agent');
			$table->tinyInteger('type')->default(0);
			$table->integer('hits')->default(1);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('jos1_stats_agents');
	}
};
