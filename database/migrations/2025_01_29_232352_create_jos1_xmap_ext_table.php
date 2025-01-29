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
		Schema::create('jos1_xmap_ext', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->string('extension', 100);
			$table->tinyInteger('published')->nullable()->default(0);
			$table->text('params')->nullable()->default(null);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('jos1_xmap_ext');
	}
};
