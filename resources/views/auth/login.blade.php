@extends('app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			<p>
				L'area di amministrazione è riservata alle persone autorizzate in possesso della password.
			</p>
			<p>
				Da qui è possibile modificare i menu, i prezzi e le configurazioni generiche dell'applicazione.
			</p>
		</div>
	</div>

	<br/>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="email" value="admin@pioola.it">

				<div class="form-group">
					<label class="col-md-2 control-label" for="password">Password</label>
					<div class="col-md-10">
						<input class="form-control" type="password" name="password">
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">Login</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection