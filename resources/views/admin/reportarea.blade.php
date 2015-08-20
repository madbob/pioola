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

		<div class="panel-heading">
			<h3 class="panel-title">Menu Omaggio <span class="badge pull-right">{{ $donated[$area->id] }}</span></h3>
		</div>

		<div class="panel-footer">
			<h3 class="panel-title">Totale <span class="badge pull-right">{{ sprintf('%.02f', $totals[$area->id]) }} €</span></h3>
		</div>
	</div>
</div>