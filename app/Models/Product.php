<?php

namespace App\Models;

use App\Casts\SlugCast;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Traits\Models\HasSlug;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'slug',
        'title',
        'price',
        'is_on_main_page',
        'sorting'
    ];

    protected $casts = [
        'slug' => SlugCast::class,
    ];

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function scopeHomePage(Builder $query)
    {
        $query->where('is_on_main_page', true)->orderBy('sorting')->limit(6);

    }

}
