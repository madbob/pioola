<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
	public static function build()
	{
		$configs = Config::get();
		$ret = [];

		foreach($configs as $c)
			$ret[$c->name] = $c->value;

		return $ret;
	}
}
