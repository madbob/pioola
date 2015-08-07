<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Backstage extends Model
{
	public function movements()
	{
		return $this->hasMany('App\Movement', 'object_id')->orderBy('created_at', 'desc');
	}
}
