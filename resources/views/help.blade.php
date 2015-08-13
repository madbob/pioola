@extends('app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<p>
				Pioola è diviso in Aree, Categorie e Portate.
			</p>
			<p>
				Una <b>Area</b> è un chiosco della sagra, una delle diverse aree di cui si compone l'evento, con un suo proprio menu. Ad esempio "Ristorante", "Pizzeria", "Bar"... Ciascuna Area ha un suo pannello Cassa, da cui effettuare gli ordini.
			</p>
			<p>
				Una <b>Categoria</b> è un insieme di portate aggregate tra loro. Ogni Area ha le proprie Categorie, l'insieme delle Categorie compone il menù. Ad esempio "Primi", "Secondi", "Bevande"...
			</p>
			<p>
				Una <b>Portata</b> è una singola voce all'interno del menu (o, per meglio dire, all'interno di una Categoria). Ad esempio nella Categoria "Bevande" ci sono "Acqua" e "Birra", e nella Categoria "Primi" ci sono "Agnolotti" e "Spaghetti".
			</p>
			<p>&nbsp;</p>
			<p>
				Ogni Portata ha una quantità a magazzino, che può essere manualmente specificata e direttamente incrementata di un dato numero. Tale quantità, se specificata, viene scalata quando la Portata viene inserita in un ordine.
			</p>
			<p>
				Esiste un'area speciale chiamata <b>Comune</b>, le cui Portate sono riportate nei menù di tutte le Aree. Utile ad esempio per aggregare elementi comuni, tipo le bottigliette d'acqua. Ovviamente anche le Portate nell'Area Comune possono avere una quantità a magazzino, che viene ugualmente scalata dagli ordini effettuati su tutte le Aree.
			</p>
		</div>
	</div>
</div>

@endsection
