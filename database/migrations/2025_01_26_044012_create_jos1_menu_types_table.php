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
		Schema::create('jos1_menu_types', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->string('menutype', 75);
			$table->string('title');
			$table->string('description');
		});

		Schema::table('jos1_menu_types', function (Blueprint $table) {
			$table->index('menutype', 'menutype');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_menu_types', function (Blueprint $table) {
			$table->dropIndex('menutype');
		});

		Schema::dropIfExists('jos1_menu_types');
	}
};
