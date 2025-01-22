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
		Schema::create('jos1_jce_extensions', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->integer('pid')->default(0);
			$table->string('name', 100);
			$table->string('extension');
			$table->string('folder');
			$table->tinyInteger('published')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('jos1_jce_extensions');
	}
};
