<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	public function details()
	{
		return $this->hasMany('App\OrderRow');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
