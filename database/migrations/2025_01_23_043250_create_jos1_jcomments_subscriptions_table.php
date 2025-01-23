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
		Schema::create('jos1_jcomments_subscriptions', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->integer('object_id')->default(0);
			$table->string('object_group');
			$table->string('lang');
			$table->integer('userid')->default(0);
			$table->string('name');
			$table->string('email');
			$table->string('hash');
			$table->tinyInteger('published')->default(0);
		});

		Schema::table('jos1_jcomments_subscriptions', function (Blueprint $table) {
			$table->index(['object_id', 'object_group'], 'idx_object');
			$table->index('lang', 'idx_lang');
			$table->index('hash', 'idx_hash');
		});

	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_jcomments_subscriptions', function (Blueprint $table) {
			$table->dropIndex('idx_object');
			$table->dropIndex('idx_lang');
			$table->dropIndex('idx_hash');
		});
		Schema::dropIfExists('jos1_jcomments_subscriptions');
	}
};
