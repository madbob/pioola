@extends('app')

@section('content')

<div class="container" id="admin-discounts">
	@include('admin.menu', ['active' => 'discounts'])

	<div class="row">
		<div class="page-header">
			<h2>Buoni Pasto</h2>
		</div>

		<p>
			Qui il valore dei buoni pasto distribuiti durante l'iniziativa. Ogni tipologia sarà visualizzata e selezionabile in fase di creazione di un ordine.
		</p>

		<table class="table" id="all-discounts">
			<thead>
				<tr>
					<th>Valore (in Euro)</th>
					<th>Elimina</th>
				</tr>
			</thead>
			<tbody>
				@foreach($tickets as $ticket)
					@include('admin.editdiscount', ['ticket' => $ticket])
				@endforeach
			</tbody>
		</table>

		<button class="btn btn-default add-discountrow"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Aggiungi</button>
	</div>

	<div class="row">
		<hr />
		<button class="btn btn-primary btn-lg" id="save-discounts"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Salva Tutto</button>
	</div>
</div>

<div id="injectable">
	<table>
		@include('admin.editdiscount', ['ticket' => null])
	</table>
</div>

@endsection