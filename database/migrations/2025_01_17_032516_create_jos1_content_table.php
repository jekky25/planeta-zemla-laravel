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
		Schema::create('jos1_content', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->string('title');
			$table->string('alias');
			$table->string('title_alias');
			$table->mediumText('introtext');
			$table->mediumText('fulltext');
			$table->tinyInteger('state')->default(0);
			$table->integer('sectionid')->default(0);
			$table->integer('mask')->default(0);
			$table->integer('catid')->default(0);
			$table->dateTime('created');
			$table->integer('created_by')->default(0);
			$table->string('created_by_alias');
			$table->dateTime('modified');
			$table->integer('modified_by')->default(0);
			$table->integer('checked_out')->default(0);
			$table->dateTime('checked_out_time');
			$table->dateTime('publish_up');
			$table->dateTime('publish_down');
			$table->text('images');
			$table->text('urls');
			$table->text('attribs');
			$table->integer('version')->default(1);
			$table->integer('parentid')->default(0);
			$table->integer('ordering')->default(0);
			$table->text('metakey');
			$table->text('metadesc');
			$table->integer('access')->default(0);
			$table->integer('hits')->default(0);
			$table->text('metadata');
		});

		Schema::table('jos1_content', function (Blueprint $table) {
			$table->index('sectionid',		'idx_section');
			$table->index('access',			'idx_access');
			$table->index('checked_out',	'idx_checkout');
			$table->index('state',			'idx_state');
			$table->index('catid',			'idx_catid');
			$table->index('created_by',		'idx_createdby');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_content', function (Blueprint $table) {
			$table->dropIndex('idx_section');
			$table->dropIndex('idx_access');
			$table->dropIndex('idx_checkout');
			$table->dropIndex('idx_state');
			$table->dropIndex('idx_catid');
			$table->dropIndex('idx_createdby');
		});

		Schema::dropIfExists('jos1_content');
	}
};
