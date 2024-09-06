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
			$table->unsignedBigInteger('parent_id')->nullable()->index();
			$table->boolean('is_active')->default(true)->index();
			$table->string('title', 190)->index();
			$table->longText('description')->nullable();
			$table->timestamps();
		});

        Schema::create('products', function (Blueprint $table) {
            $table->id();
			$table->string('title');
			$table->string('short_description');
			$table->string('description');
			$table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
			$table->foreignId('category_id')->constrained('product_categories')->cascadeOnUpdate()->cascadeOnDelete();
			$table->integer('image_id')->unsigned()->nullable();
			$table->boolean('is_active')->default(true);
			$table->decimal('price',8,2)->default(0);
			$table->decimal('old_price',8,2)->default(0);
			$table->unsignedSmallInteger('in_stock')->nullable();
            $table->timestamps();
        });

		Schema::create('product_category_relations', function (Blueprint $table) {
			$table->unsignedBigInteger('category_id');
			$table->unsignedBigInteger('product_id');
			$table->unsignedInteger('level')->default(0)->index();
			$table->primary([
				'category_id',
				'product_id',
			]);
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
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');

    }
};
