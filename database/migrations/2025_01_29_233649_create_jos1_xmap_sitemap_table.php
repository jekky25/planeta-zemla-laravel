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
		Schema::create('jos1_xmap_sitemap', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->string('name')->nullable()->default(null);
			$table->integer('expand_category')->nullable()->default(null);
			$table->integer('expand_section')->nullable()->default(null);
			$table->integer('show_menutitle')->nullable()->default(null);
			$table->integer('columns')->nullable()->default(null);
			$table->integer('exlinks')->nullable()->default(null);
			$table->string('ext_image')->nullable()->default(null);
			$table->text('menus')->nullable()->default(null);
			$table->string('exclmenus')->nullable()->default(null);
			$table->integer('includelink')->nullable()->default(null);
			$table->integer('usecache')->nullable()->default(null);
			$table->integer('cachelifetime')->nullable()->default(null);
			$table->string('classname')->nullable()->default(null);
			$table->integer('count_xml')->nullable()->default(null);
			$table->integer('count_html')->nullable()->default(null);
			$table->integer('views_xml')->nullable()->default(null);
			$table->integer('views_html')->nullable()->default(null);
			$table->integer('lastvisit_xml')->nullable()->default(null);
			$table->integer('lastvisit_html')->nullable()->default(null);
			$table->string('excluded_items')->nullable()->default(null);
			$table->integer('compress_xml')->nullable()->default(null);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('jos1_xmap_sitemap');
	}
};
