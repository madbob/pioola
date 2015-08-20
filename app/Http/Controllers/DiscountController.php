<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Hash;

use App\Ticket;

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
		$data = $request->input('data');
		$data = json_decode($data);

		$tickets_ids = [];

		foreach($data->rows as $r) {
			if ($r->id == 'new')
				$ticket = new Ticket();
			else
				$ticket = Ticket::findOrFail($r->id);

			$ticket->value = $r->value;
			$ticket->save();

			$tickets_ids [] = $user->id;
		}

		Ticket::whereNotIn('id', $tickets_ids)->delete();
		return "ok";
	}
}
