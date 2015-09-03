@extends('app')

@section('content')

<div class="container">
	@if(empty($config['intro_text']) == false)
	<div class="row">
		<div class="alert alert-info">
			{{ $config['intro_text'] }}
		</div>
	</div>
	@endif

	<div class="row">
		@foreach($areas as $area)
		@if($area->trasversal == false)
		<div class="col-md-6">
			<div class="jumbotron">
				<h2>{{ $area->name }}</h2>
				<p>{{ $area->menuSnippet() }}</p>
				<p><a class="btn btn-primary btn-lg" href="{{ url('area/' . $area->id) }}" role="button">Accedi alla Cassa</a></p>
			</div>
		</div>
		@endif
		@endforeach
	</div>

	<hr/>

	@role('admin')
	<div class="row">
		<div class="col-md-6">
			<div class="jumbotron">
				<h2>Amministrazione</h2>
				<p>Configurazioni e magazzino. Accesso riservato alle persone abilitate.</p>
				<p><a class="btn btn-primary btn-lg" href="{{ url('admin/') }}" role="button">Accedi</a></p>
			</div>
		</div>
	</div>
	@endrole

	@if($user->area_id != -1)
	<div class="row">
		<div class="col-md-6">
			<div class="jumbotron">
				<h2>Amministrazione {{ $myarea->name }}</h2>
				<p>Configurazioni area {{ $myarea->name }}. Accesso riservato alle persone abilitate.</p>
				<p><a class="btn btn-primary btn-lg" href="{{ url('area/' . $myarea->id . '/edit') }}" role="button">Accedi</a></p>
			</div>
		</div>
	</div>
	@endif
</div>

@endsection
