<tr class="combo-row" <?php if($combo == null) echo ' id="new-combo-row"' ?>>
	<td>
		<input type="hidden" name="id" value="<?php if($combo != null) echo $combo->id; else echo 'new' ?>">
		<input class="form-control" type="text" name="name" placeholder="Nome" value="<?php if($combo != null) echo $combo->name ?>" required="required">
	</td>

	<td>
		<select class="form-control" name="area_id">
			@foreach($areas as $area)
				<?php if($area->trasversal == true) continue; ?>
				<option value="{{ $area->id }}"<?php if($combo != null && $combo->area_id == $area->id) echo ' selected="selected"' ?>>{{ $area->name }}</option>
			@endforeach
		</select>
	</td>

	<td class="selectable_categories">
		<?php

		if ($combo != null)
			$categories = $combo->categories_id();
		else
			$categories = [];

		?>

		@foreach($areas as $area)
			@if($area->trasversal == false)
				<div class="selectable_area <?php if($combo == null || $combo->area_id != $area->id) echo 'hidden ' ?> area_{{ $area->id }}">
					@foreach($area->categories as $cat)
						<div class="checkbox">
							<label>
								<input type="checkbox" value="{{ $cat->id }}"<?php if(array_search($cat->id, $categories) !== false) echo ' checked="checked"' ?>> {{ $cat->name }}
							</label>
						</div>
					@endforeach

					@foreach($areas as $tarea)
						@if($tarea->trasversal == true)
							@foreach($tarea->categories as $cat)
								<div class="checkbox">
									<label>
										<input type="checkbox" value="{{ $cat->id }}"<?php if(array_search($cat->id, $categories) !== false) echo ' checked="checked"' ?>> {{ $cat->name }}
									</label>
								</div>
							@endforeach
						@endif
					@endforeach
				</div>
			@endif
		@endforeach
	</td>

	<td>
		<input class="form-control" type="text" name="price" placeholder="Prezzo" value="<?php if($combo != null) echo $combo->price ?>" required="required">
	</td>

	<td class="text-right">
		<a class="btn btn-danger remove-comborow"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a>
	</td>
</tr>