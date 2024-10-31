<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
		Schema::table('categories', function (Blueprint $table) {
			$table->boolean('is_on_main_page')->default(false);
			$table->integer('sorting')->default(999);

		});
    }

};
