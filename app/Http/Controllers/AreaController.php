<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Area;
use App\Category;
use App\Dish;
use App\Config;

class AreaController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$data['areas'] = Area::orderBy('name', 'asc')->get();
		$data['config'] = Config::build();
		return view('welcome', $data);
	}

	public function create()
	{
	}

	public function store(Request $request)
	{
		$area = new Area();
		$area->name = $request->input('name');
		$area->save();
		return redirect()->back();
	}

	public function show($id)
	{
		$areas = Area::where('trasversal', '=', true)->get();
		$a = Area::findOrFail($id);
		$areas->prepend($a);

		$data['config'] = Config::build();
		$data['areas'] = $areas;
		return view('main', $data);
	}

	public function edit($id)
	{
		$data['area'] = Area::findOrFail($id);
		return view('admin.editarea', $data);
	}

	public function update(Request $request, $id)
	{
		$data = $request->input('data');
		$data = json_decode($data);

		$area = Area::findOrFail($id);
		if ($area->name != $data->name) {
			$area->name = $data->name;
			$area->save();
		}

		$cat_ids = [];
		$dish_ids = [];

		foreach($data->categories as $c) {
			if ($c->id == 'new')
				$category = new Category();
			else
				$category = Category::findOrFail($c->id);

			$category->name = $c->name;
			$category->area_id = $id;
			$category->save();
			$cat_ids [] = $category->id;

			$sorting = 0;

			foreach($c->dishes as $d) {
				if ($d->id == 'new')
					$dish = new Dish();
				else
					$dish = Dish::findOrFail($d->id);

				$dish->name = $d->name;
				$dish->category_id = $category->id;
				$dish->price = $d->price;
				$dish->disabled = !$d->available;

				/*
					I prodotti percui non viene specificata una quantita'
					sono messi a -1, in modo da poterli distingere da quelli
					che una quantita' ce l'hanno (ed e' a 0)
				*/
				if (empty($d->quantity) == false) {
					if (empty($d->addquantity) == false && $d->addquantity != 0)
						$dish->quantity = $d->quantity + $d->addquantity;
					else
						$dish->quantity = $d->quantity;
				}
				else {
					$dish->quantity = -1;
				}

				$dish->sorted = $sorting++;
				$dish->save();
				$dish_ids [] = $dish->id;
			}
		}

		$removed_cats = Category::where('area_id', '=', $id)->whereNotIn('id', $cat_ids)->get();
		foreach($removed_cats as $rc)
			Dish::where('category_id', '=', $rc->id)->delete();

		Category::where('area_id', '=', $id)->whereNotIn('id', $cat_ids)->delete();
		Dish::whereIn('category_id', $cat_ids)->whereNotIn('id', $dish_ids)->delete();

		return "ok";
	}

	public function destroy($id)
	{
	}

	public function printer($id)
	{
		$areas = Area::where('trasversal', '=', true)->get();
		$a = Area::findOrFail($id);
		$areas->prepend($a);

		$data['areas'] = $areas;
		return view('admin.printarea', $data);
	}
}
