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
		Schema::create('jos1_ccnewsletter_newsletters', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->text('name');
			$table->text('body');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('jos1_ccnewsletter_newsletters');
	}
};
