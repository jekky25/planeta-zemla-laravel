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
		Schema::create('jos1_jp_stats', function (Blueprint $table) {
			$table->bigInteger('id')->autoIncrement();
			$table->string('description');
			$table->longText('comment');
			$table->dateTime('backupstart');
			$table->dateTime('backupend');
			$table->enum('status', ['run', 'fail', 'complete'])->default('run');
			$table->enum('origin', ['backend', 'frontend'])->default('backend');
			$table->enum('type', ['full', 'dbonly', 'extradbonly'])->default('full');
			$table->bigInteger('profile_id')->default(1);
			$table->longText('archivename')->nullable();
			$table->longText('absolute_path')->nullable();
			$table->integer('multipart')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('jos1_jp_stats');
	}	
};
