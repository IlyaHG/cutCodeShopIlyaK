<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
		Schema::create('categories', function (Blueprint $table): void {
			$table->id();
			$table->string('title');
			$table->string('slug')->unique();
            $table->boolean('is_on_main_page')->default(false);
			$table->integer('sorting')->default(999);

			$table->timestamps();
		});

    }

    public function down(): void
    {
        if(app()->isLocal()) {
            Schema::dropIfExists('categories');
        }
    }
};
