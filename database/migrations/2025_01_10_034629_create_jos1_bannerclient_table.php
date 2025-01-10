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
		Schema::create('jos1_bannerclient', function (Blueprint $table) {
			$table->integer('cid');
			$table->string('name');
			$table->string('contact');
			$table->string('email');
			$table->text('extrainfo');
			$table->tinyInteger('checked_out')->default(0);
			$table->time('checked_out_time')->nullable();
			$table->string('editor')->nullable();
		});

		Schema::table('jos1_bannerclient', function (Blueprint $table) {
            $table->primary('cid');
        });
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_bannerclient', function (Blueprint $table) {
			$table->dropPrimary('cid');
		});
		Schema::dropIfExists('jos1_bannerclient');
	}
};