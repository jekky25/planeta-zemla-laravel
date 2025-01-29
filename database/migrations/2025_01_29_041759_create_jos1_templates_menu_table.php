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
		Schema::create('jos1_templates_menu', function (Blueprint $table) {
			$table->string('template');
			$table->integer('menuid')->default(0);
			$table->tinyInteger('client_id')->default(0);
		});

		Schema::table('jos1_templates_menu', function (Blueprint $table) {
			$table->primary(['menuid', 'client_id', 'template'], 'PRIMARY');
		});

	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_templates_menu', function (Blueprint $table) {
			$table->dropPrimary('PRIMARY');
		});

		Schema::dropIfExists('jos1_templates_menu');
	}
};
