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
		Schema::create('jos1_messages', function (Blueprint $table) {
			$table->integer('message_id')->autoIncrement();
			$table->integer('user_id_from')->default(0);
			$table->integer('user_id_to')->default(0);
			$table->integer('folder_id')->default(0);
			$table->dateTime('date_time');
			$table->integer('state')->default(0);
			$table->integer('priority')->default(0);
			$table->text('subject');
			$table->text('message');
		});

		Schema::table('jos1_messages', function (Blueprint $table) {
			$table->index(['user_id_to', 'state'], 'useridto_state');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_messages', function (Blueprint $table) {
			$table->dropIndex('useridto_state');
		});

		Schema::dropIfExists('jos1_messages');
	}
};
