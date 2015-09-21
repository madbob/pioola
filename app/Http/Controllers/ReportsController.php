<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

use App\Order;

class ReportsController extends Controller
{

	public function getDownload(Request $request)
	{
		$orders = Order::orderBy('created_at', 'asc')->get();
		$dates = array();
		$sorted = [];

		foreach($orders as $o) {
			$area = $o->area->name;

			if (isset($sorted[$area]) == false)
				$sorted[$area] = array();

			foreach($o->details as $row) {
				if (is_object($row->dish) == false)
					continue;

				$dname = $row->dish->name;

				if (isset($sorted[$area][$dname]) == false)
					$sorted[$area][$dname] = array();

				list($date, $useless_hour) = explode(' ', $o->created_at);

				if(array_search($date, $dates) === false)
					$dates[] = $date;

				if (isset($sorted[$area][$dname][$date]) == false)
					$sorted[$area][$dname][$date] = 0;

				$sorted[$area][$dname][$date] += $row->quantity;
			}
		}

		header('Content-Type: application/csv');
		header('Content-Disposition: filename=export.csv');

		echo "Area;Piatto";
		foreach($dates as $d)
			echo ";$d";
		echo ";Totale\n";

		foreach($sorted as $areaname => $dish) {
			foreach($dish as $dishname => $days) {
				echo "$areaname;$dishname";

				$i = 0;
				$tot = 0;

				foreach($days as $d => $quantity) {
					while($d != $dates[$i]) {
						echo ";0";
						$i++;
					}

					$i++;
					$tot += $quantity;
					echo ";$quantity";
				}

				for(; $i < count($dates); $i++)
					echo ";0";

				echo ";$tot\n";
			}
		}
	}

}
