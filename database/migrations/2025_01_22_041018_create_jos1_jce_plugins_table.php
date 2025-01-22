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
		Schema::create('jos1_jce_plugins', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->string('title');
			$table->string('name');
			$table->string('type');
			$table->string('icon');
			$table->string('layout');
			$table->integer('row')->default(0);
			$table->integer('ordering')->default(0);
			$table->tinyInteger('published')->default(0);
			$table->tinyInteger('editable')->default(0);
			$table->tinyInteger('iscore')->default(0);
			$table->string('elements');
			$table->integer('checked_out')->default(0);
			$table->dateTime('checked_out_time');
		});

		Schema::table('jos1_jce_plugins', function (Blueprint $table) {
			$table->unique('name', 'plugin');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_jce_plugins', function (Blueprint $table) {
			$table->dropUnique('plugin');
		});

		Schema::dropIfExists('jos1_jce_plugins');
	}
};
