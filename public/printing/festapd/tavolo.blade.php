<style>
	img {
		max-width: 100%;
	}

	table {
		width: 100%;
		text-align: left;
	}

	.riga {
		width: 100%;
		clear: both;
		margin-bottom: 10px;
		display: table;
	}

	.col-4 {
		float: left;
		width: 33.33%;
		position: relative;
	}

	.col-8 {
		float: left;
		width: 66.66%;
		position: relative;
	}

	.destra {
		text-align: right;
	}

	.powered {
		font-size: 10px;
		margin-top: 20px;
		padding: 3px;
		text-align: center;
	}

	.powered p {
		margin: 1px;
		padding: 1px;
	}
</style>

<div class="riga">
	<div class="col-4">
		<img src="{{ url('printing/festapd/logo2.png') }}">
	</div>

	<div class="col-4 destra">
		Area {{ $order->area->name }}<br />
		Ordine Numero {{ $order->number }}
	</div>

	<div class="col-4 destra">
		{!! str_replace(' ', '<br>', $order->created_at) !!}
	</div>
</div>

<hr/>

<div class="riga">
	<div class="col-8">
		<p>Cassiere: {{ $order->user->name }}</p>
		<p>Numero Tavolo:</p>
	</div>

	<div class="col-4">
		&nbsp;
	</div>

	<div class="col-4 destra">
		<h3>COPIA PER IL TAVOLO</h3>
	</div>
</div>

<hr/>

<div class="riga">
	<table>
		<thead>
			<tr>
				<th width="30%">Descrizione</th>
				<th width="15%">Quantità</th>
				<th width="15%">Prezzo</th>
				<th width="40%">Note</th>
			</tr>
		</thead>

		<tbody>
			<?php $total = 0 ?>
			@foreach($order->details as $row)
			<tr>
				<td>{{ $row->dish->name }}</td>
				<td>{{ $row->quantity }}</td>
				<td>{{ $row->price }} €</td>
				<td>{{ $row->notes }}</td>
				<?php $total = $total + $row->price ?>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

@if($order->notes != '')
<div class="riga">
	<p>NOTE: {{ $order->notes }}</p>
</div>
@endif

<div class="riga">
	<h2>Totale: {{ sprintf('%.02f €', $order->total) }}</h2>
	@if($order->donated != '')
	<p>{{ $order->donated }}</p>
	@endif
</div>


<div class="riga">
	<div class="powered">
		<p>COOPERATIVA OFFICINE DIGITALI :: WEB/SYS/DEV/NET/ETC</p>
		<p>www.officinedigitali.org :: info@officinedigitali.org</p>
	</div>
</div>
