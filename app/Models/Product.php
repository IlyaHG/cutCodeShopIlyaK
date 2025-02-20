<?php

namespace App\Models;

use App\Traits\Models\HasSlug;
use App\Traits\Models\HasThumbnail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
	use HasFactory;
    use HasSlug;
    use HasThumbnail;


	protected $fillable = [
		'user_id',
		'category_id',
		'slug',
		'title',
		'price',
		'is_on_main_page',
		'sorting'
	];

    protected function thumbnailDir(): string
    {
        return 'products';
    }
	public function Category(): BelongsToMany
	{
		return $this->belongsToMany(Category::class);
	}

	public function brand(): BelongsTo
	{
		return $this->belongsTo(Brand::class);
	}

	public function scopeHomePage(Builder $query) {
		$query->where('is_on_main_page', true)->orderBy('sorting')->limit(6);

	}


}
