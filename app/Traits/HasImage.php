<?php

namespace App\Traits;
use App\Models\Brand;
use App\Models\Product;

trait HasImage
{
	public function getImageUrl()
	{

		// \Log::info('Current Class:', [get_class($this)]);

		switch (true) {
			case $this instanceof Product:
				return '/images/products/' . $this->id . '.jpg';

			case $this instanceof Brand:
				return '/images/brands/' . $this->id . '.png';

			default:
				return null;
		}
	}
}
