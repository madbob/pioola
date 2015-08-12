<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use DB;

use App\Area;
use App\Dish;
use App\Order;
use App\OrderRow;
use App\Config;

class OrderController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function store(Request $request)
	{
		$data = $request->input('order');
		$data = json_decode($data);

		$area = Area::find($data->area);
		$index = $area->current_index;
		$area->current_index = $area->current_index + 1;
		$area->save();

		$order = new Order();
		$order->area_id = $data->area;
		$order->number = $index;
		$order->user_id = Auth::user()->id;
		$order->notes = $data->notes;
		$order->donated = $data->donated;
		$order->save();

		foreach($data->dishes as $dish) {
			$row = new OrderRow();
			$row->order_id = $order->id;
			$row->dish_id = $dish->id;
			$row->quantity = $dish->quantity;
			$row->price = $dish->price;
			$row->notes = $dish->notes;
			$row->save();

			$d = Dish::find($dish->id);
			/*
				Le portate con quantità == -1 non hanno le quantità gestite a
				magazzino, dunque ignoro la relativa manipolazione
			*/
			if ($d->quantity != -1) {
				$d->quantity = max($d->quantity - $dish->quantity, 0);
				$d->save();
			}
		}

		echo url('order/' . $order->id . '?step=1');
	}

	public function show(Request $request, $id)
	{
		$order = Order::findOrFail($id);
		$config = Config::build();

		switch($request->input('step')) {
			case 1:
				return view('printable', ['order' => $order, 'page' => $config['print_theme'] . '.cucina', 'nextstep' => 2]);
				break;

			case 2:
				return view('printable', ['order' => $order, 'page' => $config['print_theme'] . '.tavolo', 'nextstep' => 3]);
				break;

			case 3:
				return redirect(url('area/' . $order->area_id));
				break;
		}
	}
}
