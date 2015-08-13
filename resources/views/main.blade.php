@extends('app')

@section('content')

<input type="hidden" name="area-id" value="{{ $areas->first()->id }}">

<div class="container" id="add-order">
	<div class="row hidden-xs">
		<h3>Cassa Area {{ $areas->first()->name }}</h3>
	</div>

	<div class="row printable">
		<p>
			Ordine numero <span id="ordernumber"></span>
		</p>
		<p>
			Del <span id="orderdate"></span>
		</p>
	</div>

	<div class="row">
		<div class="col-md-6" id="order-list">
			<div class="panel panel-default">
				@foreach($areas as $area)
					@foreach($area->categories as $cat)
						<div class="panel-heading hidden-xs">{{ $cat->name }}</div>
						<ul class="list-group" id="cat_{{ $cat->id }}"></ul>
					@endforeach
				@endforeach
				<div class="panel-heading" id="total">Totale<span class="badge pull-right">0.00</span></div>
			</div>

			<textarea class="form-control hidden-xs" name="order-notes" placeholder="Note generali per l'ordine"></textarea>
			<div class="printable" id="static-notes"></div>

			<div class="donation">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="donated-check" autocomplete="off"> Menu Omaggio
					</label>
				</div>

				<div class="form-group">
					<textarea class="form-control hidden-xs" name="donated" placeholder="Commento obbligatorio al menu omaggio"></textarea>
				</div>
			</div>
		</div>

		<div class="col-md-6" id="dishes-roster">
			@foreach($areas as $area)
				@foreach($area->categories as $cat)
					<h5 class="hidden-xs">{{ $cat->name }}</h5>
					@foreach($cat->availableDishes as $dish)
						<a class="btn <?php if($dish->quantity == 0) echo 'btn-danger'; else if($dish->quantity <= 10 && $dish->quantity > 0) echo 'btn-warning'; else echo 'btn-default' ?> btn-lg dish" id="{{ $dish->id }}">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {{ $dish->name }} ({{ $dish->price }} €)
						</a>
					@endforeach
				@endforeach
			@endforeach

		</div>
	</div>

	<div id="ops-options">
		<hr />

		<div class="row">
			<div class="col-md-12">
				<a class="btn btn-primary btn-lg" id="print-order"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Salva e Stampa Ordine</a>
				<a class="btn btn-default btn-lg pull-right reloadpage" id="new-order"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Nuovo Ordine</a>
				<p class="alert alert-info" id="noprint">È fortemente consigliato usare Firefox e l'estensione JS Print Setup per una agevole stampa degli ordini. <a href="https://addons.mozilla.org/it/firefox/addon/js-print-setup/">Per installare l'estensione clicca qui.</a></p>
			</div>
		</div>
	</div>
</div>

<div id="injectable">
	<li class="list-group-item dish-row">
		<div class="row">
			<div class="col-md-3">
				<div class="qutton edit-dish hidden-xs">
					<div class="edit-dialog">
						<input value="0" type="hidden" name="dish-id-edit">

						<div class="form-horizontal">
							<div class="form-group">
								<label class="col-md-4 control-label" for="dish-quantity-edit">Quantità</label>
								<div class="col-md-8">
									<input class="form-control" value="0" type="text" name="dish-quantity-edit">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label" for="dish-price-edit">Prezzo Totale</label>
								<div class="col-md-8">
									<input class="form-control" value="0" type="text" name="dish-price-edit">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label" for="dish-notes-edit">Note</label>
								<div class="col-md-8">
									<input class="form-control" value="" type="text" name="dish-notes-edit">
								</div>
							</div>
						</div>

						<a class="btn btn-primary close save-edit">Salva</a>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<p class="dish-name lead"></p>
				<p class="dish-notes"></p>
			</div>

			<div class="col-md-3 text-right">
				<span class="glyphicon glyphicon-minus remove-unit" aria-hidden="true"></span>
				<span class="badge dish-quantity">0</span>
				<span class="badge dish-price">0</span>
			</div>
		</div>
	</li>
</div>

<script type="text/javascript">
	var menu = {
		@foreach($areas as $area)
			@foreach($area->categories as $cat)
				@foreach($cat->availableDishes as $dish)
					"{{ $dish->id }}": {
						"id": {{ $dish->id }},
						"name": "{{ $dish->name }}",
						"category": {{ $cat->id }},
						"price": {{ $dish->price }},
						"quantity": {{ $dish->quantity }}
					},
				@endforeach
			@endforeach
		@endforeach
	};
</script>

@endsection
