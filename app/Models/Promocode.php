<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
	use HasFactory;

	protected $fillable = ['itemable_type', 'name', 'min_sum', 'max_sum',];

}
