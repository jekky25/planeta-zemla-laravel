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
		Schema::create('jos1_weblinks', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->integer('catid')->default(0);
			$table->integer('sid')->default(0);
			$table->string('title', 250);
			$table->string('alias');
			$table->string('url', 250);
			$table->text('description');
			$table->dateTime('date');
			$table->integer('hits')->default(0);
			$table->tinyInteger('published')->default(0);
			$table->integer('checked_out')->default(0);
			$table->dateTime('checked_out_time');
			$table->integer('ordering')->default(0);
			$table->tinyInteger('archived')->default(0);
			$table->tinyInteger('approved')->default(1);
			$table->text('params');
		});

		Schema::table('jos1_weblinks', function (Blueprint $table) {
			$table->index(['catid', 'published', 'archived'], 'catid');
		});

	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_weblinks', function (Blueprint $table) {
			$table->dropIndex('catid');
		});

		Schema::dropIfExists('jos1_weblinks');
	}
};
