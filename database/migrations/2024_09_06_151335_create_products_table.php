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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
			$table->string('title');
			$table->string('short_description');
			$table->string('description');
			$table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
			$table->foreignId('category_id')->constrained('categories')->cascadeOnUpdate()->cascadeOnDelete();
			$table->integer('image_id')->unsigned()->nullable();
			$table->boolean('is_active')->default(true);
			$table->decimal('price',8,2)->default(0);
			$table->decimal('old_price',8,2)->default(0);
			$table->unsignedSmallInteger('in_stock')->nullable();
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
        Schema::dropIfExists('products');
    }
};
