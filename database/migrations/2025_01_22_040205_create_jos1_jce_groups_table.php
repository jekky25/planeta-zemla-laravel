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
		Schema::create('jos1_jce_groups', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->string('name');
			$table->string('description');
			$table->text('users');
			$table->string('types');
			$table->text('components');
			$table->text('rows');
			$table->string('plugins');
			$table->tinyInteger('published')->default(0);
			$table->integer('ordering')->default(0);
			$table->tinyInteger('checked_out')->default(0);
			$table->dateTime('checked_out_time');
			$table->text('params');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('jos1_jce_groups');
	}
};
