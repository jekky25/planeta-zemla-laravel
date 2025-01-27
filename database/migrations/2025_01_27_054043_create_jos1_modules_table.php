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
		Schema::create('jos1_modules', function (Blueprint $table) {
			$table->integer('itemid')->autoIncrement();
			$table->text('title');
			$table->text('content');
			$table->integer('ordering')->default(0);
			$table->string('position', 50)->nullable();
			$table->integer('checked_out')->default(0);
			$table->dateTime('checked_out_time');
			$table->tinyInteger('published')->default(0);
			$table->string('module', 50)->nullable();
			$table->integer('numnews')->default(0);
			$table->tinyInteger('access')->default(0);
			$table->tinyInteger('showtitle')->default(1);
			$table->text('params');
			$table->tinyInteger('iscore')->default(0);
			$table->tinyInteger('client_id')->default(0);
			$table->text('control');
		});

		Schema::table('jos1_modules', function (Blueprint $table) {
			$table->index(['published', 'access'], 'published');
			$table->index(['module', 'published'], 'newsfeeds');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_modules', function (Blueprint $table) {
			$table->dropIndex('published');
			$table->dropIndex('newsfeeds');
		});

		Schema::dropIfExists('jos1_modules');
	}
};
