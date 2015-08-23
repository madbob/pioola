<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Redirect;
use DB;

use App\User;
use App\Area;
use App\Category;
use App\Dish;
use App\Order;
use App\Ticket;
use App\Combo;
use App\Config;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		if (Auth::user()->is('admin') == false)
			abort(503);
	}

	public function getIndex()
	{
		return Redirect::to('admin/area');
	}

	public function getArea()
	{
		$data['areas'] = Area::get();
		return view('admin.listarea', $data);
	}

	public function getDiscounts()
	{
		$data['areas'] = Area::get();
		$data['tickets'] = Ticket::get();
		$data['combos'] = Combo::get();
		return view('admin.editdiscounts', $data);
	}

	public function getReports(Request $request)
	{
		$d = null;

		if ($request->has('date'))
			$d = $request->input('date');
		else if ($request->has('area'))
			$a = $request->input('area');
		else
			$d = date('Y-m-d');

		$data['areas'] = Area::get();
		$data['tickets'] = Ticket::orderBy('value', 'asc')->get();
		$data['combos'] = Combo::orderBy('price', 'asc')->get();
		$data['dates'] = DB::table('orders')->select(DB::raw('DATE(created_at) as d'))->distinct()->orderBy('created_at', 'asc')->get();

		if ($d != null) {
			$data['orders'] = Order::where(DB::raw('DATE(created_at)'), '=', $d)->orderBy('created_at', 'asc')->get();
			$data['type'] = 'bydate';
			$data['target_date'] = $d;
		}
		else {
			$data['orders'] = Order::where('area_id', '=', $a)->orderBy('created_at', 'asc')->get();
			$data['type'] = 'byarea';
			$data['target_area'] = Area::findOrFail($a);
		}

		return view('admin.reports', $data);
	}

	public function getUsers()
	{
		$data['users'] = User::get();
		return view('admin.editusers', $data);
	}

	public function getConfig()
	{
		$data['config'] = Config::build();
		return view('admin.editconfig', $data);
	}
}
