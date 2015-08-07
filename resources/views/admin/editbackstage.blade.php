@extends('app')

@section('content')

<div class="container" id="backstage">
	@include('admin.menu', ['active' => 'backstage'])

	<div class="row">
		<form>
			<table class="table" id="all-backstage">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Quantità Attuale</th>
						<th>Movimenti</th>
						<th>Elimina</th>
					</tr>
				</thead>
				<tbody>
					@foreach($rows as $row)
						@include('admin.editbackstagerow', ['row' => $row])
					@endforeach
				</tbody>
			</table>
		</form>

		<button class="btn btn-default add-bsrow"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Aggiungi</button>
	</div>

	<div class="row">
		<hr />
		<button class="btn btn-primary btn-lg" id="save-backstage"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Salva Tutto</button>
	</div>
</div>

<div id="injectable">
	<table>
		@include('admin.editbackstagerow', ['row' => null])
	</table>
</div>

@endsection