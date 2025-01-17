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
		Schema::create('jos1_contact_details', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->string('name');
			$table->string('alias');
			$table->string('con_position')->nullable();
			$table->text('address')->nullable();
			$table->string('suburb', 100)->nullable();
			$table->string('state', 100)->nullable();
			$table->string('country', 100)->nullable();
			$table->string('postcode', 100)->nullable();
			$table->string('telephone')->nullable();
			$table->string('fax')->nullable();
			$table->mediumText('misc')->nullable();
			$table->string('image')->nullable();
			$table->string('imagepos', 20)->nullable();
			$table->string('email_to')->nullable();
			$table->tinyInteger('default_con')->default(0);
			$table->tinyInteger('published')->default(0);
			$table->integer('checked_out')->default(0);
			$table->dateTime('checked_out_time');
			$table->integer('ordering')->default(0);
			$table->text('params');
			$table->integer('user_id')->default(0);
			$table->integer('catid')->default(0);
			$table->tinyInteger('access')->default(0);
			$table->string('mobile');
			$table->string('webpage');
		});

		Schema::table('jos1_contact_details', function (Blueprint $table) {
			$table->index('catid', 'catid');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_contact_details', function (Blueprint $table) {
			$table->dropIndex('catid');
		});

		Schema::dropIfExists('jos1_contact_details');
	}
};
