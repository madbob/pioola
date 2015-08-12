@extends('app')

@section('content')

<div class="container" id="admin-reports">
	@include('admin.menu', ['active' => 'reports'])

	<div class="row">
		<div class="col-md-12 text-center">
			<div class="btn-group" role="group" aria-label="giorni">
				@foreach($dates as $date)
				<a class="btn btn-default" href="{{ url('admin/reports?date=' . $date->d) }}">{{ $date->d }}</a>
				@endforeach
			</div>
		</div>
	</div>

	<?php

	$data = [];
	$donated = [];

	foreach($areas as $area) {
		if ($area->trasversal == true)
			continue;

		$data[$area->id] = [];
		$donated[$area->id] = 0;
	}

	foreach($orders as $order) {
		if (empty($order->donated) == false) {
			$donated[$order->area_id] = $donated[$order->area_id] + 1;
			continue;
		}

		foreach($order->details as $row) {
			if (isset($data[$order->area_id][$row->dish_id]) == false)
				$data[$order->area_id][$row->dish_id] = (object) array('quantity' => 0, 'price' => 0);

			$data[$order->area_id][$row->dish_id]->quantity += $row->quantity;
			$data[$order->area_id][$row->dish_id]->price += $row->price;
		}
	}

	?>

	<div class="row">
		@foreach($areas as $area)
		@if($area->trasversal == false)
		<?php $total = 0 ?>
		<div class="col-md-6">
			<div class="well">
				<div class="page-header">
					<h3>{{ $area->name }}</h3>
				</div>

				<div class="panel panel-default">
					@foreach($area->categories as $cat)
					<div class="panel-heading">
						<h3 class="panel-title">{{ $cat->name }}</h3>
					</div>
					<ul class="list-group">
						@foreach($cat->dishes as $dish)
							<li class="list-group-item">
								{{ $dish->name }}
								@if(isset($data[$area->id][$dish->id]))
									<?php $total += $data[$area->id][$dish->id]->price ?>
									<span class="badge">{{ sprintf('%.02f', $data[$area->id][$dish->id]->price) }} €</span>
									<span class="badge">{{ $data[$area->id][$dish->id]->quantity }}</span>
								@endif
							</li>
						@endforeach
					</ul>
					@endforeach

					@foreach($areas as $tarea)
					@if($tarea->trasversal == true)
						@foreach($tarea->categories as $cat)
						<div class="panel-heading">
							<h3 class="panel-title">{{ $cat->name }}</h3>
						</div>
						<ul class="list-group">
							@foreach($cat->dishes as $dish)
								<li class="list-group-item">
									{{ $dish->name }}
									@if(isset($data[$area->id][$dish->id]))
										<?php $total += $data[$area->id][$dish->id]->price ?>
										<span class="badge">{{ sprintf('%.02f', $data[$area->id][$dish->id]->price) }} €</span>
										<span class="badge">{{ $data[$area->id][$dish->id]->quantity }}</span>
									@endif
								</li>
							@endforeach
						</ul>
						@endforeach
					@endif
					@endforeach

					<div class="panel-heading">
						<h3 class="panel-title">Menu Omaggio <span class="badge pull-right">{{ $donated[$area->id] }}</span></h3>
					</div>

					<div class="panel-footer">
						<h3 class="panel-title">Totale <span class="badge pull-right">{{ sprintf('%.02f', $total) }} €</span></h3>
					</div>
				</div>
			</div>
		</div>
		@endif
		@endforeach
	</div>
</div>

@endsection
