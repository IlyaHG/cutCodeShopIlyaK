<?php

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
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

		Schema::create('categories', function (Blueprint $table): void {
			$table->id();
			$table->string('title');
			$table->string('slug')->unique();
			$table->timestamps();
		});

		Schema::create('products', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('slug')->unique();
			$table->string('thumbnail')->nullable();
			$table->unsignedInteger('price')->default(0);
			$table->foreignIdFor(Brand::class)->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
			$table->timestamps();
		});

		Schema::create('category_product', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
			$table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();


		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(): void
	{
		if (app()->isLocal()) {
			Schema::dropIfExists('category_product');
			Schema::dropIfExists('products');
			Schema::dropIfExists('categories');

		}

	}
};
