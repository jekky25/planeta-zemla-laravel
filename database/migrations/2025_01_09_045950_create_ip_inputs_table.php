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
		Schema::create('ip_inputs', function (Blueprint $table) {
			$table->string('IP');
			$table->integer('LOGIN_COUNT')->default(0);
		});

		Schema::table('ip_inputs', function (Blueprint $table) {
            $table->unique('IP', 'IP');
        });
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('ip_inputs', function (Blueprint $table) {
			$table->dropUnique('IP');
		});
		Schema::dropIfExists('ip_inputs');
	}
};
