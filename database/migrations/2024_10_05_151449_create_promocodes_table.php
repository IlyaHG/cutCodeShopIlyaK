<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('promocodes', function (Blueprint $table) {
			$table->id();
			$table->string('itemable_type');
			$table->string('name')->unique();
			$table->integer('min_sum');
			$table->integer('max_sum');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (app()->isLocal()) {
			Schema::dropIfExists('promocodes');
		}
	}
};
