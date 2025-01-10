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
		Schema::create('jos1_banner', function (Blueprint $table) {
			$table->integer('bid');
			$table->integer('cid')->default(0);
			$table->string('type')->default('banner');
			$table->string('name');
			$table->string('alias');
			$table->integer('imptotal')->default(0);
			$table->integer('impmade')->default(0);
			$table->integer('clicks')->default(0);
			$table->string('imageurl');
			$table->string('clickurl');
			$table->dateTime('date')->nullable();
			$table->tinyInteger('showBanner')->default(0);
			$table->tinyInteger('checked_out')->default(0);
			$table->dateTime('checked_out_time');
			$table->string('editor')->nullable();
			$table->text('custombannercode')->nullable();
			$table->integer('catid')->default(0);
			$table->text('description');
			$table->tinyInteger('sticky')->default(0);
			$table->integer('ordering')->default(0);
			$table->dateTime('publish_up');
			$table->dateTime('publish_down');
			$table->text('tags');
			$table->text('params');
		});

		Schema::table('jos1_banner', function (Blueprint $table) {
            $table->primary('bid', 'PRIMARY');
			$table->index('showBanner', 'viewbanner');
			$table->index('catid', 'idx_banner_catid');
        });
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_banner', function (Blueprint $table) {
			$table->dropPrimary('PRIMARY');
			$table->dropIndex('viewbanner');
			$table->dropIndex('idx_banner_catid');
		});
		Schema::dropIfExists('jos1_banner');
	}
};