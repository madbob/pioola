@extends('app')

@section('content')

<div class="container" id="admin">
	@include('admin.menu', ['active' => 'areas'])

	<div class="row">
		<div class="col-md-12">
			<div class="qutton" id="create-area">
				<div class="edit-dialog">
					<form class="form-horizontal" method="POST" action="{{ url('area') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-2 control-label" for="name">Nome</label>
							<div class="col-md-10">
								<input class="form-control" type="text" name="name">
							</div>
						</div>

						<button type="submit" class="btn btn-primary save-edit">Salva</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		@foreach($areas as $area)
		<div class="col-md-6">
			<div class="well">
				<div class="page-header">
					<h3>{{ $area->name }} <small><a href="{{ url('area/' . $area->id . '/edit') }}">Modifica Area</a></small></h3>
				</div>

				@if($area->trasversal == true)
				<p>Gli elementi aggiunti in quest'area sono condivisi con tutte le aree.</p>
				@endif

				<div class="panel panel-default">
					@foreach($area->categories as $cat)
					<div class="panel-heading">
						<h3 class="panel-title">{{ $cat->name }}</h3>
					</div>
					<ul class="list-group">
						@foreach($cat->dishes as $dish)
							<li class="list-group-item">{{ $dish->name }}</li>
						@endforeach
					</ul>
					@endforeach
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>

@endsection
