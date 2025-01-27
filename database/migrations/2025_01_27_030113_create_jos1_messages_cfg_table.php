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
		Schema::create('jos1_messages_cfg', function (Blueprint $table) {
			$table->integer('user_id')->default(0);
			$table->string('cfg_name', 100);
			$table->string('cfg_value');
		});

		Schema::table('jos1_messages_cfg', function (Blueprint $table) {
			$table->primary(['user_id', 'cfg_name'], 'idx_user_var_name');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_messages_cfg', function (Blueprint $table) {
			$table->dropPrimary('idx_user_var_name');
		});

		Schema::dropIfExists('jos1_messages_cfg');
	}
};
