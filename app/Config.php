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

		$themes = array_diff(scandir(public_path() . '/printing'), ['..', '.']);
		$ret['print_themes'] = $themes;

		return $ret;
	}
}
