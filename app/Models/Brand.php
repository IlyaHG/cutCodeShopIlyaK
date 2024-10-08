<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;
	use HasImage;


	protected $fillable = ['title','slug','is_on_main_page','sorting'];

	protected static function boot(): void
	{
		parent::boot();

		static::creating(function(Brand $brand) {

			$brand->slug = $brand->slug ?? str($brand->title)->slug();
		});
	}

	public function products(): HasMany {
		return $this->hasMany(Product::class);
	}

	public function scopeHomePage(Builder $query) {
		$query->where('on_home_page', true)->orderBy('sorting')->limit(6);
	}
}
