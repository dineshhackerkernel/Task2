<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public function products()
	{
	return $this->hasMany(Product::class);
	}

	public function subCategories()
	{
	return $this->hasMany(Category::class);
	}
}
