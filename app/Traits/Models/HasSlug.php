<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    protected static function bootHasSlug(): void
	{
		static::creating(function (Model $item) {

			$item->slug = $item->slug
            ?? str($item->{ self::SlugFrom() })
                ->append(time())
                ->slug();
		});
	}
    public static function SlugFrom():string {
        return 'title';
    }
}
