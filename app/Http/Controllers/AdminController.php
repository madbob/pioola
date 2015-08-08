<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use DB;

use App\Area;
use App\Category;
use App\Dish;
use App\Order;
use App\Backstage;
use App\Person;
use App\Config;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
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

	public function getBackstage()
	{
		$data['rows'] = Backstage::get();
		$data['people'] = Person::orderBy('name', 'asc')->get();
		return view('admin.editbackstage', $data);
	}

	public function getReports(Request $request)
	{
		if ($request->has('date'))
			$d = $request->input('date');
		else
			$d = date('Y-m-d');

		$data['areas'] = Area::get();
		$data['orders'] = Order::where(DB::raw('DATE(created_at)'), '=', $d)->get();
		$data['dates'] = DB::table('orders')->select(DB::raw('DATE(created_at) as d'))->distinct()->orderBy('created_at', 'asc')->get();

		return view('admin.reports', $data);
	}

	public function getConfig()
	{
		$data['config'] = Config::build();
		return view('admin.editconfig', $data);
	}
}
