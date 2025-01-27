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
		Schema::create('jos1_polls', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->string('title');
			$table->string('alias');
			$table->integer('voters')->default(0);
			$table->integer('checked_out')->default(0);
			$table->dateTime('checked_out_time');
			$table->tinyInteger('published')->default(0);
			$table->integer('access')->default(0);
			$table->integer('lag')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('jos1_polls');
	}
};
