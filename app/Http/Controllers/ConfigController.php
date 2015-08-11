<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;

use App\Config;

class ConfigController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
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

		if ($request->has('password') && empty($request->input('password') == false)) {
			$u = User::first();
			$u->password = Hash::make($request->input('password'));
			$u->save();
		}

		return redirect('admin/config');
	}
}
