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
		Schema::create('jos1_users', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->string('name');
			$table->string('username', 150);
			$table->string('email', 100);
			$table->string('password', 100);
			$table->string('usertype', 25);
			$table->tinyInteger('block')->default(0);
			$table->tinyInteger('sendEmail')->nullable()->default(0);
			$table->tinyInteger('gid')->default(1);
			$table->dateTime('registerDate');
			$table->dateTime('lastvisitDate');
			$table->string('activation', 100);
			$table->text('params');
		});

		Schema::table('jos1_users', function (Blueprint $table) {
			$table->index('usertype', 'usertype');
			$table->index('name', 'idx_name');
			$table->index(['gid', 'block'], 'gid_block');
			$table->index('username', 'username');
			$table->index('email', 'email');
		});

	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_users', function (Blueprint $table) {
			$table->dropIndex('usertype');
			$table->dropIndex('idx_name');
			$table->dropIndex('gid_block');
			$table->dropIndex('username');
			$table->dropIndex('email');
		});

		Schema::dropIfExists('jos1_users');
	}
};
