@extends('app')

@section('content')

<div class="container" id="admin-reports">
	@include('admin.menu', ['active' => 'reports'])

	<div class="row noprint">
		<div class="col-md-12">
			<span>REPORT PER GIORNO: </span>
			<div class="btn-group" role="group" aria-label="giorni">
				@foreach($dates as $date)
					<a class="btn btn-default" href="{{ url('admin/reports?date=' . $date->d) }}">{{ $date->d }}</a>
				@endforeach
			</div>
		</div>
	</div>

	<div class="row noprint">
		<div class="col-md-12">
			<span>REPORT PER AREA: </span>
			<div class="btn-group" role="group" aria-label="giorni">
				@foreach($areas as $area)
					@if($area->trasversal == false)
						<a class="btn btn-default" href="{{ url('admin/reports?area=' . $area->id) }}">{{ $area->name }}</a>
					@endif
				@endforeach
			</div>
		</div>
	</div>

	<?php

	$data = [];
	$areatickets = [];
	$areacombos = [];
	$donated = [];
	$totals = [];

	foreach($tickets as $t)
		$areatickets[$t->id] = [];

	foreach($combos as $c)
		$areacombos[$c->id] = [];

	foreach($areas as $area) {
		$data[$area->id] = [];
		$donated[$area->id] = 0;
		$totals[$area->id] = 0;

		foreach($tickets as $t)
			$areatickets[$t->id][$area->id] = 0;

		foreach($combos as $c)
			if ($area->id == $c->area_id)
				$areacombos[$c->id][$area->id] = 0;
	}

	foreach($orders as $order) {
		if (empty($order->donated) == false) {
			if($order->ticket_id != 0)
				$areatickets[$order->ticket_id][$order->area_id] += 1;
			else if($order->combo_id != 0)
				$areacombos[$order->combo_id][$order->area_id] += 1;
			else if($order->total == 0)
				$donated[$order->area_id] += 1;
		}

		$totals[$order->area_id] += $order->total;

		foreach($order->details as $row) {
			if (isset($data[$order->area_id][$row->dish_id]) == false)
				$data[$order->area_id][$row->dish_id] = (object) array('quantity' => 0);

			$data[$order->area_id][$row->dish_id]->quantity += $row->quantity;
		}
	}

	?>

	<hr class="noprint">

	@if($type == 'bydate')

	<div class="row">
		@foreach($areas as $area)
			@if($area->trasversal == false)
				<div class="col-md-6">
					@include('admin.reportarea', ['method' => 'bydate', 'area' => $area, 'areas' => $areas, 'data' => $data, 'date' => $target_date, 'areatickets' => $areatickets, 'areacombos' => $areacombos, 'donated' => $donated, 'totals' => $totals])
				</div>
			@endif
		@endforeach
	</div>

	@elseif($type == 'byarea')

	<div class="row">
		<?php $total = 0 ?>
		<div class="col-md-12">
			@include('admin.reportarea', ['method' => 'byarea', 'area' => $target_area, 'areas' => $areas, 'data' => $data, 'dates' => $dates, 'areatickets' => $areatickets, 'areacombos' => $areacombos, 'donated' => $donated, 'totals' => $totals])
		</div>
	</div>

	@endif
</div>

@endsection
