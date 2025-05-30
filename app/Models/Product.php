<?php

namespace App\Models;

use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;
use Support\Casts\PriceCast;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasThumbnail;

class Product extends Model
{
	use HasFactory;
    use HasSlug;
    use HasThumbnail;
    use Searchable;


	protected $fillable = [
        'user_id',
        'category_id',
        'brand_id', // Добавляем brand_id
        'slug',
        'title',
        'price',
        'is_on_main_page',
        'sorting',
        'text'
	];
    protected $casts = [
        'price' => PriceCast::class,
    ];

    protected function thumbnailDir(): string
    {
        return 'products';
    }


    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    #[SearchUsingFullText(['title'])]
    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'text' => $this->text
        ];
    }
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }


	public function brand(): BelongsTo
	{
		return $this->belongsTo(Brand::class);
	}

    public function scopeFiltered(Builder $query)
    {
        $query->when(request('filters.brands'), function (Builder $query) {
            $query->whereIn('brand_id', request('filters.brands'));
        })->when(request('filters.price'), function (Builder $query) {
            $query->whereBetween('price', [
                request('filters.price.from', 0) * 100,
                request('filters.price.to', 100000) * 100
            ]);
        });
    }

    public function scopeSorted(Builder $query)
    {
        $query->when(request('sort'), function (Builder $query) {
            $column = request()->str('sort');
            if($column->contains('price','title')){
                $direction = $column->contains('-') ? 'desc' : 'asc';
                $query->orderBy($column->remove('-'), $direction);
            }
        });
    }
    public function scopeHomePage(Builder $query) {
        return $query->where('is_on_main_page', true)->orderBy('sorting');
    }


}
