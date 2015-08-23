@extends('app')

@section('content')

<div class="container" id="admin-area">
	<div class="row">
		<div class="col-md-12">
			<h1>Menu Area {{ $areas->first()->name }}</h1>
		</div>
	</div>

	<div id="all-categories">
		<div class="col-md-12">
			<div class="panel panel-default">
				@foreach($areas as $area)
					@foreach($area->categories as $cat)
						<div class="panel-heading hidden-xs">{{ $cat->name }}</div>
						<ul class="list-group">
							@foreach($cat->availableDishes as $dish)
								<li class="list-group-item dish-row">
									<div class="row">
										<div class="col-md-9">
											<p class="dish-name lead">{{ $dish->name }}</p>
										</div>

										<div class="col-md-3 text-right">
											<p class="badge dish-price">{{ $dish->price }}€</p>
										</div>
									</div>
								</li>
							@endforeach
						</ul>
					@endforeach
				@endforeach
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	if (typeof jsPrintSetup == "undefined" && $(window).width() > 900) {
		window.print();
	}
	else if (typeof jsPrintSetup != "undefined") {
		jsPrintSetup.clearSilentPrint();
		jsPrintSetup.setOption('orientation', jsPrintSetup.kPortraitOrientation);
		// jsPrintSetup.setOption('outputFormat', jsPrintSetup.kOutputFormatPDF);
		// jsPrintSetup.setOption('toFileName', '/tmp/mario.pdf');
		jsPrintSetup.setSilentPrint(true);
		jsPrintSetup.print();
	}

	window.onfocus = function() {
		window.history.back();
	};
</script>

@endsection
