<?php

namespace Domain\Catalog\Models;

use App\Models\Product;
use App\Traits\HasImage;
use Database\Factories\BrandFactory;
use Domain\Catalog\QueryBuilders\BrandQueryBuilder;
use Domain\Catalog\QueryBuilders\CategoryQueryBuilder;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasThumbnail;


/**
 * @method  static Brand|BrandQueryBuilder query()
 */
class Brand extends Model
{
    use HasFactory;
    use HasSlug;
    use HasThumbnail;

	protected $fillable = ['title','slug','is_on_main_page','sorting'];


	public function products(): HasMany {
		return $this->hasMany(Product::class);
	}

    public function newEloquentBuilder($query)
    {
        return new BrandQueryBuilder($query);
    }

    protected function thumbnailDir(): string
    {
       return 'brands';
    }

}
