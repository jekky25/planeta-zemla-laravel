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
		Schema::create('jos1_menu', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->string('menutype', 75)->nullable();
			$table->string('name')->nullable();
			$table->string('alias');
			$table->text('link');
			$table->string('type', 50);
			$table->tinyInteger('published')->default(0);
			$table->integer('parent')->default(0);
			$table->integer('componentid')->default(0);
			$table->integer('sublevel')->nullable()->default(0);
			$table->integer('ordering')->nullable()->default(0);
			$table->integer('checked_out')->default(0);
			$table->dateTime('checked_out_time');
			$table->integer('pollid')->default(0);
			$table->tinyInteger('browserNav')->nullable()->default(0);
			$table->tinyInteger('access')->default(0);
			$table->tinyInteger('utaccess')->default(0);
			$table->text('params');
			$table->integer('lft')->default(0);
			$table->integer('rgt')->default(0);
			$table->integer('home')->default(0);
		});

		Schema::table('jos1_menu', function (Blueprint $table) {
			$table->index(['componentid', 'menutype', 'published', 'access'], 'componentid');
			$table->index('menutype', 'menutype');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_menu', function (Blueprint $table) {
			$table->dropIndex('componentid');
			$table->dropIndex('menutype');
		});

		Schema::dropIfExists('jos1_menu');
	}
};
