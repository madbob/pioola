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

	<td class="text-right">
		<a class="btn btn-danger remove-userrow"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a>
	</td>
</tr>