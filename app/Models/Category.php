<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

	protected $fillable = [
		'parent_id',
		'is_active',
		'title',
		'description',
	];


	public function products()
	{
		return $this->hasMany(Product::class, 'category_id');
	}
	public function parent()
	{
		return $this->belongsTo(Category::class, 'parent_id');
	}
	public function children()
	{
		return $this->hasMany(Category::class, 'parent_id')->with('children');
	}

}
