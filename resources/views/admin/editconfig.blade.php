@extends('app')

@section('content')

<div class="container" id="config">
	@include('admin.menu', ['active' => 'config'])

	<div class="row">
		<div class="col-md-12">
			<form class="form-horizontal" method="POST" action="{{ url('config/save') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="form-group">
					<label class="control-label col-md-3">Testo Personalizzato Homepage</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="intro_text" value="{{ $config['intro_text'] }}">
						<p class="help-block">Questo testo apparirà in alto nella homepage, utili per segnalazioni generali allo staff.</p>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3">Tema Stampe</label>
					<div class="col-md-9">
						<select name="print_theme" class="form-control">
							@foreach($config['print_themes'] as $theme)
							<option value="{{ $theme }}"<?php if($config['print_theme'] == $theme) echo ' selected="selected"' ?>>{{ $theme }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Salva Tutto</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
