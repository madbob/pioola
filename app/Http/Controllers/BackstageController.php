<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Backstage;
use App\Person;
use App\Movement;

class BackstageController extends Controller
{
	public function postSave(Request $request)
	{
		$this->middleware('auth');

		$data = $request->input('data');
		$data = json_decode($data);

		$rows_ids = [];

		foreach($data->rows as $r) {
			if ($r->id == 'new')
				$row = new Backstage();
			else
				$row = Backstage::findOrFail($r->id);

			$row->name = $r->name;
			$row->quantity = $r->quantity;
			$row->save();
			$rows_ids [] = $row->id;
		}

		Backstage::whereNotIn('id', $rows_ids)->delete();
		return "ok";
	}

	public function postMovements(Request $request, $id)
	{
		$row = Backstage::findOrFail($id);
		$direction = $request->input('direction');
		$quantity = $request->input('quantity');
		$person = $request->input('person');

		if (is_numeric($person) == false || Person::find($person) == null) {
			$p = new Person();
			$p->name = $person;
			$p->save();
			$person = $p->id;
		}

		$movement = new Movement();
		$movement->object_id = $id;
		$movement->person_id = $person;
		$movement->quantity = $quantity;

		switch($direction) {
			case 'less':
				$movement->added = false;
				$row->quantity = $row->quantity - $quantity;
				break;

			case 'more':
				$movement->added = true;
				$row->quantity = $row->quantity + $quantity;
				break;
		}

		$movement->save();
		$row->save();
		return "ok";
	}
}
