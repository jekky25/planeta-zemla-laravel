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
		Schema::create('jos1_sections', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->string('title');
			$table->string('name');
			$table->string('alias');
			$table->text('image');
			$table->string('scope', 50);
			$table->string('image_position', 30);
			$table->text('description');
			$table->tinyInteger('published')->default(0);
			$table->integer('checked_out')->default(0);
			$table->dateTime('checked_out_time');
			$table->integer('ordering')->default(0);
			$table->tinyInteger('access')->default(0);
			$table->integer('count')->default(0);
			$table->text('params');
		});

		Schema::table('jos1_sections', function (Blueprint $table) {
			$table->index('scope', 'idx_scope');
		});

	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_sections', function (Blueprint $table) {
			$table->dropIndex('idx_scope');
		});

		Schema::dropIfExists('jos1_sections');
	}
};
