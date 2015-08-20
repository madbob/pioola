<div class="row dontprint" role="navigation">
	<div class="col-md-12 center-align">
		<ul class="nav nav-tabs">
			<li role="presentation"<?php if($active == 'areas') echo ' class="active"' ?>><a href="{{ url('admin/area') }}">Gestione Aree e Menù</a></li>
			<li role="presentation"<?php if($active == 'discounts') echo ' class="active"' ?>><a href="{{ url('admin/discounts') }}">Sconti</a></li>
			<li role="presentation"<?php if($active == 'reports') echo ' class="active"' ?>><a href="{{ url('admin/reports') }}">Rapporti</a></li>
			<li role="presentation"<?php if($active == 'users') echo ' class="active"' ?>><a href="{{ url('admin/users') }}">Utenti</a></li>
			<li role="presentation"<?php if($active == 'config') echo ' class="active"' ?>><a href="{{ url('admin/config') }}">Configurazioni</a></li>
		</ul>
	</div>
</div>

<br/>
