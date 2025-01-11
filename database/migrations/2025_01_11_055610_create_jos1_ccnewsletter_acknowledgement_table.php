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
		Schema::create('jos1_ccnewsletter_acknowledgement', function (Blueprint $table) {
			$table->integer('id')->default(0);
			$table->tinyInteger('status')->default(0);
			$table->tinyInteger('synstatus')->default(0);
			$table->tinyInteger('activation')->default(0);
			$table->string('subs_title');
			$table->mediumText('subs_content');
			$table->string('unsubs_title');
			$table->mediumText('unsubs_content');
		});

		Schema::table('jos1_ccnewsletter_acknowledgement', function (Blueprint $table) {
			$table->primary('id');
        });
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_ccnewsletter_acknowledgement', function (Blueprint $table) {
			$table->dropPrimary('id');
		});
		Schema::dropIfExists('jos1_ccnewsletter_acknowledgement');
	}
};
