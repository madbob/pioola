<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public function area()
	{
		return $this->belongsTo('App\Area');
	}

	public function dishes()
	{
		return $this->hasMany('App\Dish')->orderBy('sorted', 'asc');
	}

	public function allDishes()
	{
		return $this->hasMany('App\Dish')->withTrashed()->orderBy('sorted', 'asc');
	}
}
