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
		Schema::create('jos1_newsfeeds', function (Blueprint $table) {
			$table->integer('catid')->default(0);
			$table->integer('id')->autoIncrement();
			$table->text('name');
			$table->string('alias');
			$table->text('link');
			$table->string('filename', 200)->nullable();
			$table->tinyInteger('published')->default(0);
			$table->integer('numarticles')->default(1);
			$table->integer('cache_time')->default(3600);
			$table->tinyInteger('checked_out')->default(0);
			$table->dateTime('checked_out_time');
			$table->integer('ordering')->default(0);
			$table->tinyInteger('rtl')->default(0);
		});

		Schema::table('jos1_newsfeeds', function (Blueprint $table) {
			$table->index('published', 'published');
			$table->index('catid', 'catid');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_newsfeeds', function (Blueprint $table) {
			$table->dropIndex('published');
			$table->dropIndex('catid');
		});

		Schema::dropIfExists('jos1_newsfeeds');
	}
};
