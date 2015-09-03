<tr class="user-row" <?php if($user == null) echo ' id="new-user-row"' ?>>
	<td>
		<input type="hidden" name="id" value="<?php if($user != null) echo $user->id; else echo 'new' ?>">
		<input class="form-control" type="text" name="name" placeholder="Nome" value="<?php if($user != null) echo $user->name ?>" required="required">
	</td>

	<td>
		@if($user == null)
		<input class="form-control" type="text" name="password" value="" required="required">
		@else
		<input class="form-control" type="password" name="password" placeholder="Lascia in bianco per non modificare">
		@endif
	</td>

	<td>
		<input class="form-control" type="checkbox" name="admin"<?php if($user != null && $user->is('admin')) echo ' checked="checked"' ?>>
	</td>

	<td>
		<select class="form-control" name="area_id">
			<option value="-1"<?php if($user != null && $user->area_id == -1) echo ' selected="selected"' ?>>Nessuna</option>
			@foreach($areas as $area)
				@if($area->trasversal == false)
				<option value="{{ $area->id }}"<?php if($user != null && $user->area_id == $area->id) echo ' selected="selected"' ?>>{{ $area->name }}</option>
				@endif
			@endforeach
		</select>
	</td>

	<td class="text-right">
		<a class="btn btn-danger remove-userrow"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a>
	</td>
</tr>
