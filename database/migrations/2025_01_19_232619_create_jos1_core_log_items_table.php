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
		Schema::create('jos1_core_log_items', function (Blueprint $table) {
			$table->date('time_stamp');
			$table->string('item_table', 50);
			$table->integer('item_id')->default(0);
			$table->integer('hits')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('jos1_core_log_items');
	}
};
