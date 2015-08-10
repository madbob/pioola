<div class="row well well-lg category-block"<?php if($category == null) echo ' id="new-category-block"' ?>>
	<div class="col-md-12 form-horizontal">
		<input type="hidden" name="category_id" value="<?php if($category != null) echo $category->id; else echo 'new' ?>">

		<div class="form-group">
			<label class="col-sm-2 control-label" for="category_name">Nome Categoria</label>
			<div class="col-sm-10">
				<input class="form-control" type="text" name="category_name" placeholder="Nome Categoria" value="<?php if($category != null) echo $category->name ?>">
			</div>
		</div>

		<table class="table">
			<thead>
				<tr>
					<th></th>
					<th>Nome</th>
					<th>Prezzo</th>
					<th>Quantità</th>
					<th>Aggiungi a Magazzino</th>
					<th>Elimina</th>
				</tr>
			</thead>
			<tbody>
				@if($category != null)
					@foreach($category->dishes as $dish)
						@include('admin.editdish', ['dish' => $dish])
					@endforeach
				@endif
			</tbody>
		</table>

		<button class="btn btn-default add-dish"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>  Aggiungi</button>
		<button class="btn btn-danger pull-right remove-category"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Elimina Categoria</button>
	</div>
</div>
