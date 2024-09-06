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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
			$table->foreignId('cart_id')->constrained('carts')->cascadeOnUpdate()->cascadeOnDelete();
			$table->string('title');
			$table->foreignId('product_id')->constrained('products')->cascadeOnUpdate()->cascadeOnDelete();
			$table->string('product_type');
			$table->string('brand');
			$table->decimal('price', 10, 2);
			$table->unsignedInteger('old_price');
			$table->unsignedSmallInteger('quantity');
			$table->decimal('weight', 8, 2);
			$table->decimal('width', 8, 2);
			$table->decimal('height', 8, 2);
			$table->decimal('length', 8, 2);
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
        Schema::dropIfExists('cart_items');
    }
};
