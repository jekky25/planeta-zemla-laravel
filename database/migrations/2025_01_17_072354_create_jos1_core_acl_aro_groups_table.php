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
		Schema::create('jos1_core_acl_aro_groups', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->integer('parent_id')->default(0);
			$table->string('name');
			$table->integer('lft')->default(0);
			$table->integer('rgt')->default(0);
			$table->string('value');
		});

		Schema::table('jos1_core_acl_aro_groups', function (Blueprint $table) {
			$table->index('parent_id', 'jos1_gacl_parent_id_aro_groups');
			$table->index(['lft', 'rgt'], 'jos1_gacl_lft_rgt_aro_groups');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_core_acl_aro_groups', function (Blueprint $table) {
			$table->dropIndex('jos1_gacl_parent_id_aro_groups');
			$table->dropIndex('jos1_gacl_lft_rgt_aro_groups');
		});

		Schema::dropIfExists('jos1_core_acl_aro_groups');
	}
};
