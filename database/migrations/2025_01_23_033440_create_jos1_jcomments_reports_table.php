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
		Schema::create('jos1_jcomments_reports', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->integer('commentid')->default(0);
			$table->integer('userid')->default(0);
			$table->string('name');
			$table->string('ip', 15);
			$table->dateTime('date');
			$table->tinyText('reason');
			$table->tinyInteger('status')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('jos1_jcomments_reports');
	}
};
