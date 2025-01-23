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
		Schema::create('jos1_jp_inclusion', function (Blueprint $table) {
			$table->bigInteger('id')->autoIncrement();
			$table->integer('profile')->default(0);
			$table->string('class');
			$table->longText('value');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('jos1_jp_inclusion');
	}
};
