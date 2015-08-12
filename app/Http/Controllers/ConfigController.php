<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Hash;

use App\Config;

class ConfigController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		if (Auth::user()->is('admin') == false)
			abort(503);
	}

	public function postSave(Request $request)
	{
		$configs = Config::get();

		foreach($configs as $c) {
			if ($request->has($c->name) == true) {
				$c->value = $request->input($c->name);
				$c->save();
			}
		}

		return redirect('admin/config');
	}
}
