<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
	use HasFactory;
	use HasImage;


	protected $fillable = [
		'user_id',
		'category_id',
		'slug',
		'title',
		'price',
		'is_on_main_page',
		'sorting'
	];


	public function Category(): BelongsToMany
	{
		return $this->belongsToMany(Category::class);
	}

	public function brand(): BelongsTo
	{
		return $this->belongsTo(Brand::class);
	}

	protected static function boot(): void
	{
		parent::boot();

		static::creating(function (Product $product) {

			$product->slug = $product->slug ?? str($product->title)->slug();
		});
	}

	public function scopeHomePage(Builder $query) {
		$query->where('is_on_main_page', true)->orderBy('sorting')->limit(6);
		
	}

}
