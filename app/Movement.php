<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
	public function person()
	{
		return $this->belongsTo('App\Person');
	}

	public function element()
	{
		return $this->belongsTo('App\Backstage', 'object_id');
	}
}
