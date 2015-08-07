<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;

class CategoryController extends Controller
{
	public function index()
	{
	}

	public function create()
	{
	}

	public function store(Request $request)
	{
		$this->middleware('auth');
		$area = new Category();
		$area->name = $request->input('name');
		$area->area_id = $request->input('area_id');
		$area->save();
		return redirect()->back();
	}

	public function show($id)
	{
	}

	public function edit($id)
	{
	}

	public function update(Request $request, $id)
	{
	}

	public function destroy($id)
	{
	}
}
