<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use App\OrderRow;

class OrderController extends Controller
{
	public function index()
	{
	}

	public function create()
	{
	}

	public function store(Request $request)
	{
		$data = $request->input('order');
		$data = json_decode($data);

		$order = new Order();
		$order->area_id = $data->area;
		$order->notes = $data->notes;
		$order->save();

		foreach($data->dishes as $dish) {
			$row = new OrderRow();
			$row->order_id = $order->id;
			$row->dish_id = $dish->id;
			$row->quantity = $dish->quantity;
			$row->price = $dish->price;
			$row->notes = $dish->notes;
			$row->save();
		}

		echo $order->id;
	}

	public function show($id)
	{
	//
	}

	public function edit($id)
	{
	//
	}

	public function update(Request $request, $id)
	{
	//
	}

	public function destroy($id)
	{
	//
	}
}
