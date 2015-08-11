<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dish extends Model
{
	public function category()
	{
		return $this->belongsTo('App\Category');
	}
}
