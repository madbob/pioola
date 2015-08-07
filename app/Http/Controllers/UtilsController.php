<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UtilsController extends Controller
{
	public function help()
	{
		return view('help');
	}
}
