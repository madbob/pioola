<!DOCTYPE html>
<html>
	<head>
		<title>Pioola</title>
		<link rel="stylesheet" href="{{ url('css/bootstrap.css') }}" media="screen">
		<link rel="stylesheet" href="{{ url('css/selectize.bootstrap3.css') }}" media="screen">
		<link rel="stylesheet" href="{{ url('css/dataTables.bootstrap.css') }}" media="print">
		<link rel="stylesheet" href="{{ url('css/style.css') }}" media="screen">
		<link rel="stylesheet" href="{{ url('css/print.css') }}" media="print">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta name="csrf-token" content="{{ csrf_token() }}">
	</head>

	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right hidden-xs">
					<li><a href="{{ url('auth/logout') }}">Logout</a></li>
					<li><a href="{{ url('help') }}">Aiuto</a></li>
				</ul>
			</div>
		</nav>

		<br/>

		@yield('content')

		<br/>

		<script type="text/javascript" src="{{ url('js/jquery-2.1.1.min.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/jquery-ui.min.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/bootstrap.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/velocity.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/velocity-ui.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/quttons.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/selectize.min.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/jquery.dataTables.min.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/dataTables.bootstrap.js') }}"></script>
		<script type="text/javascript" src="{{ url('js/pioola.js') }}"></script>
	</body>
</html>
