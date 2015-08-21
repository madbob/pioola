<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
	public function area()
	{
		return $this->belongsTo('App\Area');
	}

	public function categories()
	{
		return $this->belongsToMany('App\Category');
	}

	public function categories_id()
	{
		$ret = [];

		foreach($this->categories as $cat)
			$ret[] = $cat->id;

		return $ret;
	}
}
