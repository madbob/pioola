@extends('app')

@section('content')

<div class="container" id="admin-area">
	@include('admin.menu', ['active' => 'areas'])

	<div class="row hidden-xs">
		<div class="col-md-12">
			<p>
				Se non viene indicata nessuna quantità a magazzino per una portata, si assume che il prodotto non deve essere automaticamente gestito e viene pertanto messo a quantità -1.
			</p>
			<p>
				Le singole portate, quando rimosse, non vengono realmente eliminate ma solo nascoste al fine di preservare i dati raccolti nei giorni precedenti.
				È possibile modificare il menù giorno per giorno conservando le informazioni storiche da cui poi generare i report.
				Se viene eliminata una categoria, invece, tutti i dati sono cancellati.
			</p>
			<p>
				Se viene eliminato qualcosa per errore, <a href="#" class="reloadpage">ricarica questa pagina</a> senza salvare.
			</p>
		</div>
	</div>

	<hr/>

	<div class="row form-horizontal">
		<div class="col-md-12">
			<input type="hidden" name="area_id" value="{{ $area->id }}">

			<div class="form-group form-group-lg">
				<label class="col-sm-2 control-label" for="category_name">Nome Area</label>
				<div class="col-sm-10">
					<input class="form-control" type="text" name="area_name" value="{{ $area->name }}">
				</div>
			</div>
		</div>
	</div>

	<div id="all-categories">
		@foreach($area->categories as $cat)
		@include('admin.editcategory', ['category' => $cat])
		@endforeach
	</div>

	<div class="row">
		<div class="col-md-12">
			<button class="btn btn-default add-category"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Aggiungi Categoria</button>
			<hr/>
			<button class="btn btn-primary btn-lg" id="save-area"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Salva Tutto</button>
			<button class="btn btn-default btn-lg hidden-xs" id="print-area"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Stampa Menu</button>
		</div>
	</div>
</div>

<div id="injectable">
	<table>
		@include('admin.editdish', ['dish' => null])
	</table>

	@include('admin.editcategory', ['category' => null])
</div>

@endsection
