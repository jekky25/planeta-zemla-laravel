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
		Schema::create('jos1_ccnewsletter_subscribers', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->text('name');
			$table->text('email');
			$table->tinyInteger('plainText')->default(0);
			$table->tinyInteger('enabled')->default(1);
			$table->dateTime('sdate');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('jos1_ccnewsletter_subscribers');
	}
};
