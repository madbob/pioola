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

	var discount = $('#active-discount').val();
	if (discount != 'none') {
		var d = discounts[discount];
		if (d.subtract != -1)
			tot = tot - d.subtract;
		else if (d.fixed != -1)
			tot = d.fixed;

		if (tot < 0)
			tot = 0;
	}

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

		$('.donation input[type=radio]').change(function() {
			var type = $(this).val();
			var discount = discounts[type];

			if (type != 'none')
				$('textarea[name=donated]').val(discount.descr).show();
			else
				$('textarea[name=donated]').val('').hide();

			$('#active-discount').val(type);
			refreshTotal();
		});

		$('#print-order').click(function() {
			var free = false;

			var order = {
				area: $('input[name=area-id]').val(),
				notes: $('textarea[name=order-notes]').val(),
				discount: $('#active-discount').val(),
				discount_reason: $('textarea[name=donated]').val(),
				dishes: []
			};

			$('#order-list .dish-row').each(function() {
				var id = $(this).find('input[name=dish-id-edit]').val();
				var quantity = $(this).find('input[name=dish-quantity-edit]').val();
				var price = free ? 0 : $(this).find('input[name=dish-price-edit]').val();
				var notes = $(this).find('input[name=dish-notes-edit]').val();
				order.dishes.push({'id': id, 'quantity': quantity, 'price': price, 'notes': notes});
			});

			tokenpost('/order', { 'order': JSON.stringify(order) }, function(data) {
					location.href = data;
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
		AMMINISTRAZIONE SCONTI
	*/
	if ($('#admin-discounts').length != 0) {
		$('.add-discountrow').click(function() {
			var row = $('#injectable #new-discount-row').clone();
			row.removeAttr('id');
			$('#all-discounts tbody').append(row);
			return false;
		});

		$('#admin-discounts').on('click', '.remove-discountsrow', function() {
			$(this).closest('tr').remove();
		});

		$('#save-discounts').click(function() {
			var discounts = {
				rows: []
			};

			$('#all-discounts .discount-row').each(function() {
				var ticket = {
					id: $(this).find('input[name=id]').val(),
					value: $(this).find('input[name=value]').val()
				};

				discounts.rows.push(ticket);
			});

			tokenpost('/discounts/save', { data: JSON.stringify(discounts) }, function(data) {
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
