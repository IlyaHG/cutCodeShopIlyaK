<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('brands', function (Blueprint $table) {
			$table->boolean('is_on_main_page')->default(false);
			$table->integer('sorting')->default(999);

		});
    }
	public function down() {
		Schema::table('brands', function (Blueprint $table) {
			$table->dropColumn('is_on_main_page');
			$table->dropColumn('thumbnail');
			$table->dropColumn('slug');
			$table->dropColumn('sorting');

		});
	}

};
