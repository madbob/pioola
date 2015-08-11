<tr class="bs-row" <?php if($row == null) echo ' id="new-bs-row"' ?>>
	<td>
		<input type="hidden" name="id" value="<?php if($row != null) echo $row->id; else echo 'new' ?>">
		<input class="form-control" type="text" name="name" placeholder="Nome" value="<?php if($row != null) echo $row->name ?>">
	</td>

	<td>
		<input class="form-control" type="text" name="quantity" placeholder="Quantità" value="<?php if($row != null) echo $row->quantity ?>">
	</td>

	<td>
		@if($row != null)
		<div class="qutton movements" id="{{ str_random(5) }}">
			<div class="edit-dialog edit-dialog-lg">
				<table class="table">
					<thead>
						<tr>
							<th width="40%">Chi</th>
							<th width="20%">In/Out</th>
							<th width="20%">Quanto</th>
							<th width="20%">Quando</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<select name="personselect" class="personselect" autocomplete="on">
									@foreach($people as $person)
									<option value="{{ $person->id }}">{{ $person->name }}</option>
									@endforeach
								</select>
							</td>
							<td>
								<select name="direction" class="form-control" autocomplete="on">
									<option value="less">Rimuovi</option>
									<option value="more">Aggiungi</option>
								</select>
							</td>
							<td>
								<input class="form-control" type="text" name="quantity" value="0" autocomplete="on">
							</td>
							<td>
								<a class="btn btn-primary save-movements">Salva</a>
							</td>
						</tr>

						@foreach($row->movements as $movement)
						<tr class="hidden-xs">
							<td>
								{{ $movement->person->name }}
							</td>
							<td>
								@if($movement->added)
								ha aggiunto
								@else
								ha prelevato
								@endif
							</td>
							<td>
								{{ $movement->quantity }}
							</td>
							<td>
								{{ $movement->created_at }}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		@endif
	</td>

	<td class="text-right">
		<a class="btn btn-danger remove-bsrow"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a>
	</td>
</tr>
