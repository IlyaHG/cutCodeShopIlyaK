<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

	protected $fillable = [
		'cart_id',
		'space_id',
		'title',

		'price',
		'old_price',
		'referral_sum',

		'quantity',
		
		'weight',
		'width',
		'height',
		'length',
		
		'itemable_id',
		'itemable_type',
		];
}
