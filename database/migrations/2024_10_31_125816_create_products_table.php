<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Brand;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('thumbnail')->nullable();
            $table->unsignedInteger('price')->default(0);
            $table->boolean('is_on_main_page')->default(false);
            $table->integer('sorting')->default(999);
            $table->foreignIdFor(Brand::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate(); // Убедитесь, что констрейнт указывает на существующую таблицу
            $table->timestamps();
        });
    }

    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::dropIfExists('products');
        }
    }
};
