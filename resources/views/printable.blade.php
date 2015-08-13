<!DOCTYPE html>
<html>
	<head>
		<title>Pioola</title>
		<link rel="stylesheet" href="{{ url('css/style.css') }}" media="screen">
		<link rel="stylesheet" href="{{ url('css/print.css') }}" media="print">
	</head>

	<body>
		<div class="noprint">
			<h1>STAMPA IN CORSO</h1>
		</div>

		<div class="printable">
			@include($page, ['order' => $order])
		</div>


		<script type="text/javascript">
			if (typeof jsPrintSetup == "undefined" && $(window).width() > 900) {
				window.print();
			}
			else if (typeof jsPrintSetup != "undefined") {
				jsPrintSetup.clearSilentPrint();
				jsPrintSetup.setPaperSizeData(11);
				jsPrintSetup.setOption('scaling', 60);
				jsPrintSetup.setOption('orientation', jsPrintSetup.kPortraitOrientation);
				jsPrintSetup.setOption('outputFormat', jsPrintSetup.kOutputFormatPDF);
				jsPrintSetup.setOption('toFileName', '/tmp/mario-{{ $page }}.pdf');
				jsPrintSetup.setSilentPrint(true);
				jsPrintSetup.print();
			}

			window.onfocus = function() {
				setTimeout(function() {
					location.href = "{{ url('order/' . $order->id . '?step=' . $nextstep) }}";
				}, 1000);
			};
		</script>
	</body>
</html>
