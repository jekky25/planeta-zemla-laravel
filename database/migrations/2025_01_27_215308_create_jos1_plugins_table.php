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
		Schema::create('jos1_plugins', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->string('name', 100);
			$table->string('element', 100);
			$table->string('folder', 100);
			$table->tinyInteger('access')->default(0);
			$table->integer('ordering')->default(0);
			$table->tinyInteger('published')->default(0);
			$table->tinyInteger('iscore')->default(0);
			$table->tinyInteger('client_id')->default(0);
			$table->integer('checked_out')->default(0);
			$table->dateTime('checked_out_time');
			$table->text('params');
		});

		Schema::table('jos1_plugins', function (Blueprint $table) {
			$table->index(['published', 'client_id', 'access', 'folder'], 'idx_folder');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_plugins', function (Blueprint $table) {
			$table->dropIndex('idx_folder');
		});

		Schema::dropIfExists('jos1_plugins');
	}
};
