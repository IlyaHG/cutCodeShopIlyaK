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

		Schema::create('product_categories', function (Blueprint $table) {
			$table->id();
			$table->boolean('is_active')->default(true)->index();
			$table->string('title', 190)->index();
			$table->longText('description')->nullable();
			$table->boolean('is_on_main_page')->default(1);
			$table->timestamps();
		});

        Schema::create('products', function (Blueprint $table) {
            $table->id();
			$table->string('title');
			$table->string('short_description')->nullable();
			$table->string('description')->nullable();
			$table->string('brand')->nullable();
			$table->foreignId('category_id')->constrained('product_categories')->cascadeOnUpdate()->cascadeOnDelete();
			$table->integer('image_id')->unsigned()->nullable();
			$table->decimal('price',8,2)->default(0);
			$table->decimal('old_price',8,2)->default(0);
			$table->unsignedSmallInteger('in_stock')->nullable();
            $table->timestamps();
        });

		Schema::create('product_images', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('product_id')->nullable()->index();
			$table->string('name');
			$table->string('extension')->nullable();
			$table->unsignedInteger('size')->nullable();
			$table->timestamps();

			$table->foreign('product_id')
			->references('id')
			->on('products')->cascadeOnUpdate()->cascadeOnDelete();
			
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_categories');

    }
};
