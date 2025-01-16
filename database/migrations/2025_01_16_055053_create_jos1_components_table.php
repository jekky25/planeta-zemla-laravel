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
		Schema::create('jos1_components', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->string('name', 50);
			$table->string('link');
			$table->integer('menuid')->default(0);
			$table->integer('parent')->default(0);
			$table->string('admin_menu_link');
			$table->string('admin_menu_alt');
			$table->string('option', 50);
			$table->integer('ordering')->default(0);
			$table->string('admin_menu_img');
			$table->tinyInteger('iscore')->default(0);
			$table->text('params');
			$table->tinyInteger('enabled')->default(1);
		});

		Schema::table('jos1_components', function (Blueprint $table) {
			$table->index(['parent', 'option'], 'parent_option');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_components', function (Blueprint $table) {
			$table->dropIndex('parent_option');
		});

		Schema::dropIfExists('jos1_components');
	}
};
