function tokenpost(url, data, func) {
	data._token = $('meta[name=csrf-token]').attr('content');
	$.post(url, data, func);
}

function setDishPrice(row, price) {
	row.find('.dish-price').text(price);
	row.find('input[name=dish-price-edit]').val(price);
}

function setDishQuantity(row, quantity) {
	row.find('.dish-quantity').text(quantity);
	row.find('input[name=dish-quantity-edit]').val(quantity);
}

function refreshTotal() {
	var tot = 0;

	$('#order-list .dish-row').each(function() {
		tot += parseFloat($(this).find('.dish-price').text());
	});

	$('#total .badge').text(tot.toFixed(2));
}

function saveArea(action) {
	var id = $('input[name=area_id]').val();

	var area = {
		id: id,
		name: $('input[name=area_name]').val(),
		categories: []
	};

	$('#all-categories .category-block').each(function() {
		var category = {
			id: $(this).find('input[name=category_id]').val(),
			name: $(this).find('input[name=category_name]').val(),
			dishes: []
		};

		$(this).find('.dish-row').each(function() {
			var dish = {
				id: $(this).find('input[name=id]').val(),
				name: $(this).find('input[name=name]').val(),
				price: $(this).find('input[name=price]').val(),
				quantity: $(this).find('input[name=quantity]').val(),
				available: $(this).find('.toggle-available').find('.glyphicon').hasClass('glyphicon-ok'),
				addquantity: $(this).find('input[name=addquantity]').val()
			};

			category.dishes.push(dish);
		});

		area.categories.push(category);
	});

	$.ajax({
		url: '/area/' + id,
		type: 'PATCH',
		data: {
			_token: $('meta[name=csrf-token]').attr('content'),
			data: JSON.stringify(area)
		},
		success: function(data) {
			if (action == 'save')
				location.reload();
			else if (action == 'print')
				location.href = '/area/' + id + '/print';
		}
	});
}

$(document).ready(function() {
	$('.reloadpage').click(function() {
		location.reload();
	});

	/******************************************************************************************************************************************
		PANNELLO ORDINI
	*/
	if ($('#add-order').length != 0) {
		if (typeof jsPrintSetup == "undefined" && $(window).width() > 900) {
			$('#noprint').show();
		}
		else if ($(window).width() <= 900) {
			$('#print-order').text(' Salva Ordine');
		}

		$('a.dish').click(function() {
			var id = $(this).attr('id');
			var d = menu[id];

			if ($('.dish_' + id).length == 0) {
				var row = $('#injectable .dish-row').clone();
				row.addClass('dish_' + id);
				row.find('.dish-name').text(d.name);
				row.find('input[name=dish-id-edit]').val(id);
				var cat = $('#cat_' + d.category);
				cat.prepend(row);

				var edit = row.find('.edit-dish');
				edit.attr('id', Math.random());
				var quttonEdit = Qutton.getInstance(edit);
				quttonEdit.init({
					icon: '/img/notes.png',
					backgroundColor: "#5BC0DE"
				});
			}
			else {
				var row = $('.dish_' + id);
			}

			var q = parseInt(row.find('.dish-quantity').text()) + 1;
			setDishQuantity(row, q);
			var p = (parseFloat(row.find('.dish-price').text()) + d.price).toFixed(2);
			setDishPrice(row, p);

			var tot = parseFloat($('#total .badge').text());
			$('#total .badge').text((tot + d.price).toFixed(2));
		});

		$('#add-order').on('click', '.save-edit', function() {
			var row = $(this).closest('.dish-row');
			var q = row.find('input[name=dish-quantity-edit]').val();
			var p = parseFloat(row.find('input[name=dish-price-edit]').val());
			var n = row.find('input[name=dish-notes-edit]').val();

			row.find('.dish-quantity').text(q);
			row.find('.dish-price').text(p.toFixed(2));
			row.find('.dish-notes').text(n);

			refreshTotal();
		});

		$('#add-order').on('click', '.remove-unit', function() {
			var row = $(this).closest('.dish-row');
			var q = parseInt(row.find('.dish-quantity').text());
			if (q > 0) {
				q = q - 1;

				if (q == 0) {
					row.remove();
				}
				else {
					setDishQuantity(row, q);

					var id = row.find('input[name=dish-id-edit]').val();
					var d = menu[id];

					var p = (parseFloat(row.find('.dish-price').text()) - d.price).toFixed(2);
					if (p < 0)
						p = 0;

					setDishPrice(row, p);
				}

				refreshTotal();
			}
		});

		$('#print-order').click(function() {
			var order = {
				area: $('input[name=area-id]').val(),
				notes: $('textarea[name=order-notes]').val(),
				dishes: []
			};

			$('#order-list .dish-row').each(function() {
				var id = $(this).find('input[name=dish-id-edit]').val();
				var quantity = $(this).find('input[name=dish-quantity-edit]').val();
				var price = $(this).find('input[name=dish-price-edit]').val();
				var notes = $(this).find('input[name=dish-notes-edit]').val();
				order.dishes.push({'id': id, 'quantity': quantity, 'price': price, 'notes': notes});
			});

			tokenpost('/order', { 'order': JSON.stringify(order) }, function(data) {
					$('#ordernumber').text(data);
					var d = new Date();
					$('#orderdate').text(d.toLocaleDateString());
					$('#static-notes').text($('textarea[name=order-notes]').val());

					if (typeof jsPrintSetup == "undefined" && $(window).width() > 900) {
						window.print();
					}
					else if (typeof jsPrintSetup != "undefined") {
						jsPrintSetup.clearSilentPrint();
						jsPrintSetup.setOption('orientation', jsPrintSetup.kPortraitOrientation);
						jsPrintSetup.setOption('outputFormat', jsPrintSetup.kOutputFormatPDF);
						jsPrintSetup.setOption('toFileName', '/tmp/mario.pdf');
						jsPrintSetup.setSilentPrint(true);
						jsPrintSetup.print();
					}
					else {
						$('#new-order').click();
						return;
					}

					/*
						Invocare subito il click() su #new-order non funziona, perche' la
						stampa e' in corso. In questo caso si assume che la finestra sara'
						temporaneamente oscurata dalla finestra di print progress,
						pertanto si attiva un trigger per quando la finestra avra'
						nuovamente il focus
					*/
					window.onfocus = function() {
						$('#new-order').click();
					};
				}
			);
		});
	}

	/******************************************************************************************************************************************
		HOME AMMINISTRAZIONE
	*/
	if ($('#admin').length != 0) {
		var quttonEdit = Qutton.getInstance($('#create-area'));
		quttonEdit.init({
			icon: '/img/add.png',
			backgroundColor: "#5BC0DE"
		});
	}

	/******************************************************************************************************************************************
		AMMINISTRAZIONE AREA
	*/
	if ($('#admin-area').length != 0) {
		$('.category-block tbody').sortable({
			handle: '.sorthandle'
		});

		$('#admin-area').on('click', '.add-dish', function() {
			var row = $('#injectable #new-dish-row').clone();
			row.removeAttr('id');
			$(this).siblings('table').append(row);
			return false;
		});

		$('#admin-area').on('click', '.remove-dish', function() {
			$(this).closest('tr').remove();
		});

		$('#admin-area').on('click', '.toggle-available', function() {
			var icon = $(this).find('.glyphicon');
			if (icon.hasClass('glyphicon-ok'))
				icon.removeClass('glyphicon-ok').addClass('glyphicon-remove');
			else
				icon.removeClass('glyphicon-remove').addClass('glyphicon-ok');
		});

		$('.add-category').click(function() {
			var row = $('#injectable #new-category-block').clone();
			row.removeAttr('id');
			$('#all-categories').append(row);
			row.find('tbody').sortable({
				handle: '.sorthandle'
			});
			return false;
		});

		$('#admin-area').on('click', '.remove-category', function() {
			$(this).closest('.category-block').remove();
		});

		$('#print-area').click(function() {
			saveArea('print');
		});

		$('#save-area').click(function() {
			saveArea('save');
		});
	}

	/******************************************************************************************************************************************
		AMMINISTRAZIONE RETROBOTTEGA
	*/
	if ($('#backstage').length != 0) {
		$('#all-backstage .bs-row').each(function() {
			var quttonEdit = Qutton.getInstance($(this).find('.movements'));
			quttonEdit.init({
				icon: '/img/people.png',
				backgroundColor: "#5BC0DE"
			});
		});

		$('.personselect').selectize({
			create: true,
			sortField: 'text'
		});

		$('.add-bsrow').click(function() {
			var row = $('#injectable #new-bs-row').clone();
			row.removeAttr('id');
			$('#all-backstage tbody').append(row);
			return false;
		});

		$('#backstage').on('click', '.remove-bsrow', function() {
			$(this).closest('tr').remove();
		});

		$('.movements table').DataTable({
			info: false,
			searching: false,
			ordering:  false,
			pageLength: 5,
			lengthChange: false,
			paging: true
		});

		$('#save-backstage').click(function() {
			var backstage = {
				rows: []
			};

			$('#all-backstage .bs-row').each(function() {
				var row = {
					id: $(this).find('input[name=id]').val(),
					name: $(this).find('input[name=name]').val(),
					quantity: $(this).find('input[name=quantity]').val()
				};

				backstage.rows.push(row);
			});

			tokenpost('/backstage/save', { data: JSON.stringify(backstage) }, function(data) {
					location.reload();
				}
			);
		});

		/*
			Questo e' per evitare che i click sui link per la paginazione della
			tabella dei movimenti si propaghi al $(document), provocando la chiusura
			del qutton (cfr. evento click_document nel prototipo della classe Qutton)
		*/
		$('.movements .dataTables_paginate').click(function(event) {
			event.stopPropagation();
		});

		$('.save-movements').click(function() {
			var row = $(this).closest('tr');
			var id = $(this).closest('.bs-row').find('input[name=id]').val();

			tokenpost('/backstage/movements/' + id, {
					person: row.find('select[name=personselect]').val(),
					direction: row.find('select[name=direction]').val(),
					quantity: row.find('input[name=quantity]').val()
				},
				function(data) {
					location.reload();
				}
			);
		});
	}

	/******************************************************************************************************************************************
		AMMINISTRAZIONE UTENTI
	*/
	if ($('#admin-users').length != 0) {
		$('.add-userrow').click(function() {
			var row = $('#injectable #new-user-row').clone();
			row.removeAttr('id');
			var animals = ['cane', 'gatto', 'leone', 'scoiattolo', 'passero', 'elefante', 'tacchino', 'serpente', 'pinguino', 'bue'];
			var colors = ['rosso', 'verde', 'blu', 'bianco', 'nero', 'grigio', 'giallo', 'viola', 'marrone', 'arancione'];
			var password = animals[Math.floor(Math.random() * animals.length)] + ' ' + colors[Math.floor(Math.random() * colors.length)];
			row.find('input[name=password]').val(password);
			$('#all-users tbody').append(row);
			return false;
		});

		$('#admin-users').on('click', '.remove-userrow', function() {
			$(this).closest('tr').remove();
		});

		$('#save-users').click(function() {
			var users = {
				rows: []
			};

			$('#all-users .user-row').each(function() {
				var user = {
					id: $(this).find('input[name=id]').val(),
					name: $(this).find('input[name=name]').val(),
					password: $(this).find('input[name=password]').val(),
					admin: $(this).find('input[name=admin]').is(':checked')
				};

				users.rows.push(user);
			});

			tokenpost('/users/save', { data: JSON.stringify(users) }, function(data) {
					location.reload();
				}
			);
		});
	}
});
