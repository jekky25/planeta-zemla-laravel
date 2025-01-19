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
		Schema::create('jos1_core_acl_groups_aro_map', function (Blueprint $table) {
			$table->integer('group_id')->default(0);
			$table->string('section_value', 240);
			$table->integer('aro_id')->default(0);
		});

		Schema::table('jos1_core_acl_groups_aro_map', function (Blueprint $table) {
			$table->unique(['group_id', 'section_value', 'aro_id'], 'group_id_aro_id_groups_aro_map');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_core_acl_groups_aro_map', function (Blueprint $table) {
			$table->dropUnique('group_id_aro_id_groups_aro_map');
		});

		Schema::dropIfExists('jos1_core_acl_groups_aro_map');
	}
};
