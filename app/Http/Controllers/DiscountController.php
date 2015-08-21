<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Hash;

use App\Ticket;
use App\Combo;

class DiscountController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		if (Auth::user()->is('admin') == false)
			abort(503);
	}

	public function postSave(Request $request)
	{
		$data = $request->input('tickets');
		$data = json_decode($data);

		$tickets_ids = [];

		foreach($data->rows as $r) {
			if ($r->id == 'new')
				$ticket = new Ticket();
			else
				$ticket = Ticket::findOrFail($r->id);

			$ticket->value = $r->value;
			$ticket->save();

			$tickets_ids [] = $ticket->id;
		}

		Ticket::whereNotIn('id', $tickets_ids)->delete();

		$data = $request->input('combos');
		$data = json_decode($data);

		$combos_ids = [];

		foreach($data->rows as $r) {
			if ($r->id == 'new')
				$combo = new Combo();
			else
				$combo = Combo::findOrFail($r->id);

			$combo->name = $r->name;
			$combo->area_id = $r->area_id;
			$combo->price = $r->price;
			$combo->save();

			$combo->categories()->sync($r->categories);

			$combos_ids [] = $combo->id;
		}

		Combo::whereNotIn('id', $combos_ids)->delete();

		return "ok";
	}
}
