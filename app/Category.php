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

	public function availableDishes()
	{
		return $this->hasMany('App\Dish')->where('disabled', '=', false)->orderBy('sorted', 'asc');
	}
}
