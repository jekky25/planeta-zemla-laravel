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
		Schema::create('jos1_jp_registry', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->integer('profile')->default(1);
			$table->string('key');
			$table->longText('value');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('jos1_jp_registry');
	}
};
