<?php

declare(strict_types= 1);

namespace App\Traits\Models;

use App\Models\Product;

use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    protected static function bootHasSlug(): void
	{
		parent::boot();

		static::creating(function (Model $item) {

			$item->slug = $item->slug
            ?? str($item->{self::slugFrom()})
                ->append(time())
                ->slug();
		});
	}

    public static function slugFrom(): string  {

        return 'title';
    }

}
