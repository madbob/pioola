<tr class="discount-row" <?php if($ticket == null) echo ' id="new-discount-row"' ?>>
	<td>
		<input type="hidden" name="id" value="<?php if($ticket != null) echo $ticket->id; else echo 'new' ?>">
		<input class="form-control" type="text" name="value" placeholder="Valore" value="<?php if($ticket != null) echo $ticket->value ?>" required="required">
	</td>

	<td class="text-right">
		<a class="btn btn-danger remove-discountrow"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a>
	</td>
</tr>