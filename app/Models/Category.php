<?php

namespace App\Models;

use App\Traits\Models\HasSlug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
	use HasFactory;
    use HasSlug;

	protected $fillable = ['title', 'slug','description','is_on_main_page','sorting'];

	public function products(): BelongsToMany {
		return $this->belongsToMany(Product::class);
	}
	public function scopeHomePage(Builder $query) {
		$query->where('is_on_main_page', true)->orderBy('sorting')->limit(6);

	}
}
