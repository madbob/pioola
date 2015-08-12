@extends('app')

@section('content')

<div class="container" id="config">
	@include('admin.menu', ['active' => 'config'])

	<div class="row">
		<div class="col-md-12">
			<form class="form-horizontal" method="POST" action="{{ url('config/save') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="form-group">
					<label class="control-label col-md-3">Intestazione Ordini</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="head_documents" value="{{ $config['head_documents'] }}">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3">Testo Personalizzato Homepage</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="intro_text" value="{{ $config['intro_text'] }}">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3">Testo Personalizzato Stampe</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="print_footer_text" value="{{ $config['print_footer_text'] }}">
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
