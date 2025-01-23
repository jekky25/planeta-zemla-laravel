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
		Schema::create('jos1_jcomments', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->integer('parent')->default(0);
			$table->string('path');
			$table->tinyInteger('level')->default(0);
			$table->integer('object_id')->default(0);
			$table->string('object_group');
			$table->text('object_params');
			$table->string('lang');
			$table->integer('userid')->default(0);
			$table->string('name');
			$table->string('username');
			$table->string('email');
			$table->string('homepage');
			$table->string('title');
			$table->text('comment');
			$table->char('ip', 15);
			$table->dateTime('date');
			$table->smallInteger('isgood')->default(0);
			$table->smallInteger('ispoor')->default(0);
			$table->tinyInteger('published')->default(0);
			$table->tinyInteger('subscribe')->default(0);
			$table->string('source');
			$table->integer('source_id')->default(0);
			$table->integer('checked_out')->default(0);
			$table->dateTime('checked_out_time');
			$table->string('editor', 50);
		});

		Schema::table('jos1_jcomments', function (Blueprint $table) {
			$table->index('userid', 'idx_userid');
			$table->index('source', 'idx_source');
			$table->index('email', 'idx_email');
			$table->index('lang', 'idx_lang');
			$table->index('subscribe', 'idx_subscribe');
			$table->index('checked_out', 'idx_checkout');
			$table->index(['object_id', 'object_group', 'published', 'date'], 'idx_object');
			$table->index(['path', 'level'], 'idx_path');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_jcomments', function (Blueprint $table) {
			$table->dropIndex('idx_userid');
			$table->dropIndex('idx_source');
			$table->dropIndex('idx_email');
			$table->dropIndex('idx_lang');
			$table->dropIndex('idx_subscribe');
			$table->dropIndex('idx_checkout');
			$table->dropIndex('idx_object');
			$table->dropIndex('idx_path');
		});

		Schema::dropIfExists('jos1_jcomments');
	}
};
