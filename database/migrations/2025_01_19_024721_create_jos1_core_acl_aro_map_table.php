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
		Schema::create('jos1_core_acl_aro_map', function (Blueprint $table) {
			$table->integer('acl_id')->default(0);
			$table->string('section_value', 230)->default(0);
			$table->string('value', 100);
		});

		Schema::table('jos1_core_acl_aro_map', function (Blueprint $table) {
			$table->primary(['acl_id', 'section_value', 'value']);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_core_acl_aro_map', function (Blueprint $table) {
			$table->dropPrimary(['acl_id', 'section_value', 'value']);
		});

		Schema::dropIfExists('jos1_core_acl_aro_map');
	}
};
