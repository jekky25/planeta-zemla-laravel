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
		Schema::create('jos1_jcomments_custom_bbcodes', function (Blueprint $table) {
			$table->integer('id')->autoIncrement();
			$table->string('name', 64);
			$table->string('simple_pattern');
			$table->text('simple_replacement_html');
			$table->text('simple_replacement_text');
			$table->string('pattern');
			$table->text('replacement_html');
			$table->text('replacement_text');
			$table->text('button_acl');
			$table->string('button_open_tag', 16);
			$table->string('button_close_tag', 16);
			$table->string('button_title');
			$table->string('button_prompt');
			$table->string('button_image');
			$table->string('button_css');
			$table->tinyInteger('button_enabled')->default(0);
			$table->integer('ordering')->default(0);
			$table->tinyInteger('published')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('jos1_jcomments_custom_bbcodes');
	}
};
