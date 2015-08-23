<div class="well areareport">
	<div class="page-header noprint">
		<h3>{{ $area->name }}</h3>
	</div>
	<div class="page-header printable">
		@if($method == 'bydate')
		<h3>{{ $area->name }} - {{ $target_date }}</h3>
		@elseif($method == 'byarea')
		<h3>{{ $area->name }} - {{ $dates[0]->d }} / {{ $dates[count($dates) - 1]->d }}</h3>
		@endif
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
							<span class="badge">{{ $data[$area->id][$dish->id]->quantity }}</span>
						@endif
					</li>
				@endforeach
			</ul>
			@endforeach
		@endif
		@endforeach

		@foreach($tickets as $t)
		<div class="panel-heading">
			<h3 class="panel-title">Buono {{ $t->value }} € <span class="badge pull-right">{{ $areatickets[$t->id][$area->id] }}</span></h3>
		</div>
		@endforeach

		@foreach($combos as $c)
			@if ($area->id == $c->area_id)
				<div class="panel-heading">
					<h3 class="panel-title">Menu {{ $c->name }}<span class="badge pull-right">{{ $areacombos[$c->id][$area->id] }}</span></h3>
				</div>
			@endif
		@endforeach

		<div class="panel-heading">
			<h3 class="panel-title">Menu Omaggio <span class="badge pull-right">{{ $donated[$area->id] }}</span></h3>
		</div>

		<div class="panel-footer">
			<h3 class="panel-title">Totale <span class="badge pull-right">{{ sprintf('%.02f', $totals[$area->id]) }} €</span></h3>
		</div>
	</div>
</div>
