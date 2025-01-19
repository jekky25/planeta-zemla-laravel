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
		Schema::create('jos1_groups', function (Blueprint $table) {
			$table->tinyInteger('id')->default(0);
			$table->string('name', 50);
		});

		Schema::table('jos1_groups', function (Blueprint $table) {
			$table->primary('id');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_groups', function (Blueprint $table) {
			$table->dropPrimary('id');
		});

		Schema::dropIfExists('jos1_groups');
	}
};
