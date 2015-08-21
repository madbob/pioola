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
		<div class="page-header">
			<h2>Menu</h2>
		</div>

		<p>
			Qui le combinazioni di portate, divise per area, con prezzo fisso. Ogni combinazione potrà essere selezionata in fase di creazione di un ordine, a patto che le condizioni siano soddisfatte.
		</p>

		<table class="table" id="all-combos">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Area</th>
					<th>Categorie</th>
					<th>Prezzo</th>
					<th>Elimina</th>
				</tr>
			</thead>
			<tbody>
				@foreach($combos as $combo)
					@include('admin.editcombo', ['combo' => $combo])
				@endforeach
			</tbody>
		</table>

		<button class="btn btn-default add-comborow"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Aggiungi</button>
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

	<table>
		@include('admin.editcombo', ['combo' => null])
	</table>
</div>

@endsection
