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
		Schema::create('jos1_session', function (Blueprint $table) {
			$table->string('username', 150)->nullable();
			$table->string('time', 14)->nullable();
			$table->string('session_id', 200)->default(0);
			$table->tinyInteger('guest')->nullable()->default(1);
			$table->integer('userid')->nullable()->default(0);
			$table->string('usertype', 50)->nullable();
			$table->tinyInteger('gid')->default(0);
			$table->tinyInteger('client_id')->default(0);
			$table->longText('data')->nullable()->default(null);
		});

		Schema::table('jos1_session', function (Blueprint $table) {
			$table->primary('session_id', 'PRIMARY');
			$table->index(['guest', 'usertype'], 'whosonline');
			$table->index('userid', 'userid');
			$table->index('time', 'time');
		});

	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_session', function (Blueprint $table) {
			$table->dropPrimary('PRIMARY');
			$table->dropIndex('whosonline');
			$table->dropIndex('userid');
			$table->dropIndex('time');
		});

		Schema::dropIfExists('jos1_session');
	}
};
