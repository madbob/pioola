<style>

	body{
		font-size: 120%;	
		font-family: arial, sans-serif;
	}

	img {
		max-width: 100%;
	}
	
	h3.copiaper{
		margin: 0;
		padding: 0;
		margin-bottom: 5px;		
	}
	
	table {
		width: 100%;
		text-align: left;
	}

	.riga {
		width: 100%;
		clear: both;
		margin-bottom: 0.5em;
		padding-bottom: 0.5em;
		border-bottom: 1px solid #999;
		display: table;
		
	}
	
	.riga.totale{
		margin: 0:
		padding: 0;
	}
	
	.riga.totale h2,
	.riga.totale p{
		margin: 0;
		padding: 0;
		margin-top: 0.2em;
		margin-bottom: 0.2em;
	}
	
	.riga tr.testata{
		border-bottom: 1px solid #000;
	}
	
	.riga th,
	.riga td {
		padding-left: 1.5%;
		padding-right: 1.5%;
		padding-top: 2px;
		padding-bottom: 2px;
	}
	
	.riga td.quantita,
	.riga th.quantita{
		text-align: right;
		font-weight: bold;
	}
	
	.riga td.note{
		font-size: 100%;		
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
		Area {{ $order->area->name }}<br/>
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
		<h3 class="copiaper" >PER LA CUCINA</h3>
	</div>
</div>

<hr/>

<div class="riga">
	<table>
		<thead>
			<tr class="testata">
				<th width="32%" class="descrizione">Descrizione</th>
				<th width="8%" class="quantita">Q.ta</th>
				<th width="15%" class="prezzo">Prezzo</th>
				<th width="33%" class="note">Note</th>
			</tr>
		</thead>

		<tbody>
			<?php $total = 0 ?>
			@foreach($order->details as $row)
			<tr>
				<td class="descrizione">{{ $row->dish->name }}</td>
				<td class="quantita">{{ $row->quantity }}</td>
				<td class="prezzo">{{ $row->price }} €</td>
				<td class="note">{{ $row->notes }}</td>
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

<div class="riga totale">
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
