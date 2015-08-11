<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Area extends Model
{
	public function categories()
	{
		return $this->hasMany('App\Category');
	}

	public function menuSnippet()
	{
		$names = [];

		foreach($this->categories as $cat) {
			$dishes = $cat->availableDishes;
			foreach($dishes as $dish)
				$names[] = $dish->name;
		}

		return join(', ', $names);
	}
}
