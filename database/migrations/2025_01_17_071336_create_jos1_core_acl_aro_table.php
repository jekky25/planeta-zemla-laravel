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
		Schema::create('jos1_core_acl_aro', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->string('section_value');
			$table->string('value', 0);
			$table->integer('order_value')->default(0);
			$table->string('name');
			$table->integer('hidden')->default(0);
		});

		Schema::table('jos1_core_acl_aro', function (Blueprint $table) {
			$table->index(['section_value', 'value'], 'jos1_section_value_value_aro');
			$table->index('hidden', 'jos1_gacl_hidden_aro');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('jos1_core_acl_aro', function (Blueprint $table) {
			$table->dropIndex('jos1_section_value_value_aro');
			$table->dropIndex('jos1_gacl_hidden_aro');
		});

		Schema::dropIfExists('jos1_core_acl_aro');
	}
};
