<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

	protected $fillable = [
		'user_id',
		'space_id',
		'category_id',
		'image_id',
		'is_active',
		'title',
		'short_description',
		'description',
		'barcode_ean13',
		'price',
		'old_price',
		'in_stock',
	];
}
