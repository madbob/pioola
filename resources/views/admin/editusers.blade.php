@extends('app')

@section('content')

<div class="container" id="admin-users">
	@include('admin.menu', ['active' => 'users'])

	<div class="row">
		<table class="table" id="all-users">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Password</th>
					<th>Amministratore</th>
					<th>Elimina</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
					@include('admin.edituser', ['user' => $user])
				@endforeach
			</tbody>
		</table>

		<button class="btn btn-default add-userrow"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Aggiungi</button>
	</div>

	<div class="row">
		<hr />
		<button class="btn btn-primary btn-lg" id="save-users"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Salva Tutto</button>
	</div>
</div>

<div id="injectable">
	<table>
		@include('admin.edituser', ['user' => null])
	</table>
</div>

@endsection