<tr class="dish-row" <?php if($dish == null) echo ' id="new-dish-row"' ?>>
	<td>
		<span class="glyphicon glyphicon-sort sorthandle" aria-hidden="true"></span>
	</td>
	<td>
		<input type="hidden" name="id" value="<?php if($dish != null) echo $dish->id; else echo 'new' ?>">
		<input class="form-control" type="text" name="name" placeholder="Nome" value="<?php if($dish != null) echo $dish->name ?>">
	</td>

	<td>
		<input class="form-control" type="text" name="price" placeholder="Prezzo" value="<?php if($dish != null) echo $dish->price ?>">
	</td>

	<td>
		<input class="form-control" type="text" name="quantity" placeholder="Quantità" value="<?php if($dish != null && $dish->quantity != 0) echo $dish->quantity ?>">
	</td>

	<td>
		@if($dish != null)
		<input class="form-control" type="text" name="addquantity" value="">
		@else
		<input type="hidden" name="addquantity" value="0">
		@endif
	</td>

	<td class="text-right">
		<a class="btn btn-warning toggle-available"><span class="glyphicon <?php if($dish == null || $dish->disabled == false) echo 'glyphicon-ok'; else echo 'glyphicon-remove' ?>" aria-hidden="true"></span> </a>
		<a class="btn btn-danger remove-dish"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a>
	</td>
</tr>
