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
		Schema::create('jos1_xmap_items', function (Blueprint $table) {
			$table->string('uid', 100);
			$table->integer('itemid')->default(0);
			$table->string('view', 10);
			$table->integer('sitemap_id')->default(0);
			$table->text('properties')->nullable()->default(null);
		});

		Schema::table('jos1_xmap_items', function (Blueprint $table) {
			$table->primary(['uid', 'itemid', 'view', 'sitemap_id'] , 'PRIMARY');
			$table->index(['uid', 'itemid'], 'uid');
			$table->index('view', 'view');
		});

	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_xmap_items', function (Blueprint $table) {
			$table->dropPrimary('PRIMARY');
			$table->dropIndex('uid');
			$table->dropIndex('view');
		});

		Schema::dropIfExists('jos1_xmap_items');
	}
};
