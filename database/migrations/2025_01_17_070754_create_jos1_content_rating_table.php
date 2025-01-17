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
		Schema::create('jos1_content_rating', function (Blueprint $table) {
			$table->integer('content_id')->default(0);
			$table->integer('rating_sum')->default(0);
			$table->integer('rating_count')->default(0);
			$table->string('lastip', 50);
		});

		Schema::table('jos1_content_rating', function (Blueprint $table) {
			$table->primary('content_id');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_content_rating', function (Blueprint $table) {
			$table->dropPrimary('content_id');
		});

		Schema::dropIfExists('jos1_content_rating');
	}
};
