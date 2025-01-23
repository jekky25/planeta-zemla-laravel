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
		Schema::create('jos1_jcomments_votes', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->integer('commentid')->default(0);
			$table->integer('userid')->default(0);
			$table->string('ip', 15);
			$table->dateTime('date');
			$table->tinyInteger('value');
		});

		Schema::table('jos1_jcomments_votes', function (Blueprint $table) {
			$table->index(['commentid', 'userid'], 'idx_comment');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_jcomments_votes', function (Blueprint $table) {
			$table->dropIndex('idx_comment');
		});
		Schema::dropIfExists('jos1_jcomments_votes');
	}
};
