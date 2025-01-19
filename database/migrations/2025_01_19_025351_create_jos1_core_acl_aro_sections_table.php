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
		Schema::create('jos1_core_acl_aro_sections', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->string('value', 230);
			$table->integer('order_value')->default(0);
			$table->string('name', 230);
			$table->integer('hidden')->default(0);
		});

		Schema::table('jos1_core_acl_aro_sections', function (Blueprint $table) {
			$table->index('value', 'jos1_gacl_value_aro_sections');
			$table->index('hidden', 'jos1_gacl_hidden_aro_sections');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_core_acl_aro_sections', function (Blueprint $table) {
			$table->dropIndex('jos1_gacl_value_aro_sections');
			$table->dropIndex('jos1_gacl_hidden_aro_sections');
		});

		Schema::dropIfExists('jos1_core_acl_aro_sections');
	}
};
