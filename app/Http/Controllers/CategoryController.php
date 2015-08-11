<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

use App\Category;

class CategoryController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		if (Auth::user()->is('admin') == false)
			abort(503);
	}

	public function store(Request $request)
	{
		$area = new Category();
		$area->name = $request->input('name');
		$area->area_id = $request->input('area_id');
		$area->save();
		return redirect()->back();
	}

}
