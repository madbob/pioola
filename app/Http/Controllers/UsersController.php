<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Hash;
use Bican\Roles\Models\Role;

use App\User;

class UsersController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		if (Auth::user()->is('admin') == false)
			abort(503);
	}

	public function postSave(Request $request)
	{
		$data = $request->input('data');
		$data = json_decode($data);

		$users_ids = [];

		foreach($data->rows as $r) {
			if ($r->id == 'new')
				$user = new User();
			else
				$user = User::findOrFail($r->id);

			$user->name = $r->name;
			$user->area_id = $r->area_id;

			if (empty($r->password) == false)
				$user->password = Hash::make($r->password);

			$user->save();

			if ($r->admin == true && $user->is('admin') == false)
				$user->attachRole(Role::where('slug', '=', 'admin')->first());
			else if ($r->admin == false && $user->is('admin') == true)
				$user->detachRole(Role::where('slug', '=', 'admin')->first());

			$users_ids [] = $user->id;
		}

		User::whereNotIn('id', $users_ids)->delete();
		return "ok";
	}
}
