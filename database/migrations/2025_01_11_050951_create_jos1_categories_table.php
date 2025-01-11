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
		Schema::create('jos1_categories', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->integer('parent_id')->default(0);
			$table->string('title');
			$table->string('name');
			$table->string('alias');
			$table->string('image');
			$table->string('section');
			$table->string('image_position');
			$table->text('description');
			$table->tinyInteger('published')->default(0);
			$table->integer('checked_out')->default(0);
			$table->dateTime('checked_out_time');
			$table->string('editor')->nullable();
			$table->integer('ordering')->default(0);
			$table->tinyInteger('access')->default(0);
			$table->integer('count')->default(0);
			$table->text('params');
		});

		Schema::table('jos1_categories', function (Blueprint $table) {
			$table->index(['section', 'published', 'access'], 'cat_idx');
			$table->index('access', 'idx_access');
			$table->index('checked_out', 'idx_checkout');
        });
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_categories', function (Blueprint $table) {
			$table->dropIndex('cat_idx');
			$table->dropIndex('idx_access');
			$table->dropIndex('idx_checkout');
		});
		Schema::dropIfExists('jos1_categories');
	}
};
