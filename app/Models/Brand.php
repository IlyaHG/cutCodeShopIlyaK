<?php

namespace App\Models;

use App\Traits\HasImage;
use App\Traits\Models\HasSlug;
use App\Traits\Models\HasThumbnail;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;
	use HasImage;
    use HasSlug;
    use HasThumbnail;

	protected $fillable = ['title','slug','is_on_main_page','sorting'];


	public function products(): HasMany {
		return $this->hasMany(Product::class);
	}

	public function scopeHomePage(Builder $query) {
		$query->where('is_on_main_page', true)->orderBy('sorting')->limit(6);
	}

    protected function thumbnailDir(): string
    {
       return 'brands';
    }
}
