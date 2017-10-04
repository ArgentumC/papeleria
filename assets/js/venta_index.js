$(document).ready(function() {
	var timer = null;

	crearVentaTemp();

	//selDetalleVentaTemp();

	$("#campo_captura").focus();	

	// Al hacer Enter en el campo de captura, dispara la búsqueda
	$('#campo_captura').keydown(function(e) {
		if (e.keyCode == 13) {
			e.preventDefault();
			buscarProducto("",0);
		}
	});

	//Funciones para la consulta de producto desde el grid de botones
	$(document).on('touchstart', '.product-button', function() {
		timer = setTimeout( doStuff, 700 );
	});	

	$(document).on('touchend', '.product-button', function() {
		clearTimeout(timer);
	});		

	$(document).on('mousedown', '.product-button', function() {
		timer = setTimeout( doStuff, 500 );
	});

	$(document).on('mouseup', '.product-button', function() {
		clearTimeout(timer);
	});	

	// Botón para seleccionar del grid un producto y agregarlo a la venta
	$(document).on('click', '.product-button', function() {
		var trLineaProducto = buscarProductoExistenteEnVenta($(this).data("idproducto"));

		if(trLineaProducto == null) {
			buscarProducto("",$(this).data("idproducto"));
		}
		else
		{
			sumarUnidad(trLineaProducto.find('.btn-sumar'), 1);
			//alert('encontrado');
		}
	});	
	//---------------------------------------------------------------------

	function doStuff() {
		alert('Esto se muestra al mantener presionado el boton por 0.5 segundos.');
	}	

	// Fin consulta de producto grid de botones
	//---------------------------------------------------------------------

	// Botón para Quitar Producto------------------------------
	$(document).on('click','.btn-quitarProducto',function() {
		borrarDetalleVentaTemp($(this));
	});
	//---------------------------------------------------------------------

	// Botón para abrir ventana de Temporales------------------------------
	$(document).on('click','#btnVerTemporales',function() {
		selVentaTemp(0);
	});
	//---------------------------------------------------------------------

	// Botón para seleccionar y abrir Venta Temporal-----------------------
	$(document).on('click','.btnVentaTemp',function() {
		selDetalleVentaTemp($(this).data("cveventa"));
		$('#modal-temp').modal('hide');
	});
	//---------------------------------------------------------------------
	
	// Botón para abrir ventana de Guardar Venta---------------------------
	$(document).on('click','#btnAbrirGuardarVenta',function() {
		cargarTotales_ventanaGuardarVenta();
	});
	//---------------------------------------------------------------------

	// Botón para Guardar Venta--------------------------------------------
	$(document).on('click','#btnGuardarVenta',function() {
		//guardarVenta();
	});	
	//---------------------------------------------------------------------
	
	// Botón para cambiar la Unidad de Venta del producto seleccionado-----
	$(document).on('click','.btn-toggleUnidad',function() {
		alternarUnidadPartida($(this));
	});		
	//---------------------------------------------------------------------

	//---------------------------------------------------------------------
	
	// Botón para Sumar una unidad a la cantidad del producto seleccionado-
	$(document).on('click','.btn-sumar',function() {
		sumarUnidad($(this), 1);
	});		
	//---------------------------------------------------------------------	

	// Botón para Restar una unidad a la cantidad del producto seleccionado-
	$(document).on('click','.btn-restar',function() {
		sumarUnidad($(this), -1);
	});		
	//---------------------------------------------------------------------		

	// Botón para ConfirmarGuardar Venta--------------------------------------------
	$(document).on('click','#btnConfirmarGuardarVenta',function() {
		guardarVenta();
	});	
	//---------------------------------------------------------------------	
});

	function buscarProductoExistenteEnVenta(idproducto)
	{
		var trLineaProducto = null;

		$('.tr-linea').each(function () {
			if($(this).children('.td-idproducto').children('.idproducto').val() == idproducto)
			{
				trLineaProducto = $(this);
			}
		})

		return trLineaProducto;
	}

	function sumarUnidad(botonSumar, cantidadSumar)
	{
		var dventatemp_id = obtener_dventatemp_id_desde_boton(botonSumar);

		data = "dventatemp_id="+dventatemp_id;
		data += "&cantidadSumar="+cantidadSumar;

		$.ajax({
			type: 	'ajax',
			method: 'post',
			url: 	'venta/sumarUnidad',
			data: 	data,
			async: 	false,
			dataType: 'json',
			success: function(data) {
				//alert('Unidad alternada exitosamente: ' + data[0].correcto);

				var padre = botonSumar.parent().parent();

				padre.children('.cantidad').text(data[0].dvcantidad);

				obtenerTotal();
			},
			error:function() {
				alert('No se pudo alternar la unidad de venta actual');
			}
		});		
	}

	function alternarUnidadPartida(botonPartida)
	{
		var data;

		var dventatemp_id = obtener_dventatemp_id_desde_boton(botonPartida);

		data = "dventatemp_id="+dventatemp_id;

		$.ajax({
			type: 	'ajax',
			method: 'post',
			url: 	'venta/alternarUnidadPartida',
			data: 	data,
			async: 	false,
			dataType: 'json',
			success: function(data) {
				//alert('Unidad alternada exitosamente: ' + data[0].correcto);

				var padre = botonPartida.parent().parent();

				padre.children('.lblunidad').text(data[0].cadUnidadActual);
				botonPartida.data('unidadactual', data[0].dvunidadventa);
				botonPartida.html(data[0].cadUnidadAlterna);
				padre.children('.precio').text(parseFloat(data[0].dvprecio).toFixed(2));

				obtenerTotal();
			},
			error:function() {
				alert('No se pudo alternar la unidad de venta actual');
			}
		});
		
		/*var padre = botonPartida.parent().parent();

		var lblunidad = padre.children('.lblunidad');

		var cadenaUnidad = lblunidad.text();

		lblunidad.text(botonPartida.text());

		botonPartida.text(cadenaUnidad);

		var precio = 0;

		botonPartida.data("unidadactual",lblunidad.text());

		if(lblunidad.text() == "PZA.") {
			padre.children('.precio').text(botonPartida.data("precio-venta-pieza"));
		}
		else {
			padre.children('.precio').text(botonPartida.data("precio-venta-paquete"));
		}

		obtenerTotal();*/
	}

	function cargarTotales_ventanaGuardarVenta()
	{
		$('#lblTotal').text($('#total').text());
		$('#txtRecibido').val($('#total').text());
		calcularCambio();
	}

	function calcularCambio()
	{
		var cambio = parseFloat($('#lblTotal').text()) - parseFloat($('#txtRecibido').val());
		$('#lblCambio').text(cambio.toFixed(2));
	}

	function crearVentaTemp()
	{
		var cveVenta;

		$.ajax({
			type:'ajax',
			url: 'venta/crearVentaTemp',
			async:false,
			dataType: 'json',

			success: function(data) {
				$('#cveVenta').val(data[0].cveVenta);
				$('#tipoVenta').val('t');
				//alert($('#cveVenta').val());
			},
			error: function() {
				alert('No se pudo crear la venta temporal');
			}
		});
	}

	function obtenerTotal()
	{
		var sum = 0;
		var value=0;

		$('.precio').each(function() {
			value = $(this).text();
			if(!isNaN(value) && value.length != 0) {
				sum += parseFloat($(this).parent().children('.cantidad').text()) * parseFloat(value);
			}
		});

		$('#total').text(sum.toFixed(2));
	}

	function selDetalleVentaTemp(cveVenta) {
		var data;
		data = 'cveVenta=' + cveVenta;

		$.ajax({
			type:'ajax',
			url: 'venta/selDetalleVentaTemp',
			method: 'post',
			data : data,
			async:false,
			dataType: 'json',

			success: function(data) {
				var html = '';
				var i;

				var precioventa;
				var unidadDefault;
				var cadBotonToggle = '&nbsp;';


				for(i=0;i<data.length; i++) {
					cadBotonToggle = "";
					if(data[i].cadUnidadAlterna != "")
					{
						cadBotonToggle = '<button class="btn btn-default btn-sm btn-toggleUnidad" ' +
							'data-dventatemp_id='+dventatemp_id + '>' + data.cadUnidadAlterna + '</a></td>'
					}

					html +='<tr class="tr-linea">'+
					'<td class="td-idproducto" style="width:10%">' +
					'<input type="hidden" class="dventatemp_id" value="' + data[i].dventatemp_id + '" > ' +
					'<input type="hidden" class="idproducto" value="'+ data[i].dvidproducto + '" >' +
					'<button class="btn btn-sm btn-quitarProducto btn-danger">Quitar&nbsp;' +
					'<span class="glyphicon glyphicon-remove glyphicon-align:left"></span>' +
					'</button>'+
					'</td>'+	
					'<td style="width:5%" class="lblunidad" valign="middle">'+data[i].cadUnidad+'</td>'+
					'<td style="width:10%">'+
					cadBotonToggle + '</td>'+
					'<td style="width:47%">'+data[i].nombreproducto+'</td>'+
					'<td class="cantidad" style="text-align:right;padding-right:5px;width:10%">'+data[i].dvcantidad+'</td>'+
					'<td style="width:4%"><button class="btn btn-sm btn-default btn-sumar" >+</button></td>'+
					'<td style="width:4%"><button class="btn btn-sm btn-default btn-restar" >-</button></td>'+
					'<td class="precio" style="text-align:right;padding-right:5px;width:10%">'+ data[i].dvprecio +'</td>'+
					'</tr>';							
				}
				$('#showdata').html(html);

				$('#cveVenta').val(cveVenta);
				
				mostrarUltimaLinea();

				obtenerTotal();
			},
			error: function() {
				alert('No se pudieron cargar los datos');
			}
		});
	}	


	function buscarProducto(cadena,idproducto)
	{
		var data;
		if(idproducto == 0)
		{
			data = $('#formCapturaProd').serialize();
			data += "&idproducto=0";
		}
		else
		{
			data = "txtCaptura=";
			data += "&idproducto=" + idproducto;
		}


		$.ajax({
			type: 	'ajax',
			method: 'post',
			url: 	'venta/buscarProducto',
			data: 	data,
			async: 	false,
			dataType: 'json',
			success: function(data) {
				if(data.length == 1) {
					agregarProducto(data[0]);
				} else {
					llenarPanelSeleccion(data);
				}
			},
			error: function() {
				alert('No se pudieron cargar los datos');
			}
		});
		$("#campo_captura").focus();
	}

	function insertarDetalleVentaTemp(idproducto)
	{
		var data;
		var dventatemp_id = 0;

		var cveVenta = $('#cveVenta').val();

		data = "cveVenta=" + cveVenta;
		data += "&idproducto=" + idproducto;

		$.ajax({
			type: 	'ajax',
			method: 'post',
			url: 	'venta/insertarDetalleVentaTemp',
			data: 	data,
			async: 	false,
			dataType: 'json',
			success: function(data) {
				dventatemp_id = data[0].dventatemp_id;
			},
			error:function() {
				alert('No se pudo agregar el Producto a la venta actual');
			}
		});


		return dventatemp_id;
	}

	function agregarProducto(data)
	{
		var trLineaProducto = buscarProductoExistenteEnVenta(data.idproducto);

		if(trLineaProducto == null) {
			var dventatemp_id = insertarDetalleVentaTemp(data.idproducto);

			if(dventatemp_id > 0)
			{
				var precioventa;
				var unidadDefault;
				var cadBotonToggle = '&nbsp;';

				if(data.cadUnidadAlterna != "")
				{
					cadBotonToggle = '<button class="btn btn-default btn-sm btn-toggleUnidad" ' +
						'data-dventatemp_id='+dventatemp_id + '>' + data.cadUnidadAlterna + '</a></td>'
				}

				var html = '';
				html +='<tr class="tr-linea">'+
				'<td class="td-idproducto" style="width:10%">' +
				'<input type="hidden" class="dventatemp_id" value="' + dventatemp_id + '" > ' +
				'<input type="hidden" class="idproducto" value="'+ data.idproducto + '" >' +
				'<button class="btn btn-sm btn-quitarProducto btn-danger">Quitar&nbsp;' +
				'<span class="glyphicon glyphicon-remove glyphicon-align:left"></span>' +
				'</button>'+
				'</td>'+	
				'<td style="width:5%" class="lblunidad" valign="middle">'+data.cadUnidad+'</td>'+
				'<td style="width:10%">'+
				cadBotonToggle + '</td>'+
				'<td style="width:47%">'+data.nombreproducto+'</td>'+
				'<td class="cantidad" style="text-align:right;padding-right:5px;width:10%">1</td>'+
				'<td style="width:4%"><button class="btn btn-sm btn-default btn-sumar" >+</button></td>'+
				'<td style="width:4%"><button class="btn btn-sm btn-default btn-restar" >-</button></td>'+
				'<td class="precio" style="text-align:right;padding-right:5px;width:10%">'+ data.precioVenta +'</td>'+
				'</tr>';	

				$('#showdata').append(html);
				mostrarUltimaLinea();
			}
		}
		else
		{
			sumarUnidad(trLineaProducto.find('.btn-sumar'), 1);
			//alert('encontrado');
		}

		obtenerTotal();
		$('#campo_captura').val('');
	}

	function llenarPanelSeleccion(data)
	{
		var i;
		var html = '';

		$('#product_buttons').empty();
		for(i=0;i<data.length;i++) {
			html += '<button class="product-button" data-idproducto=' + data[i].idproducto +'>'+data[i].nombreproducto+'</button>';
		}
		$('#product_buttons').append(html);
	}

	function mostrarUltimaLinea()
	{
		//Hace scroll hasta mostrar la última línea de la venta

		//var rowpos = $('#table_catalogo tr:last').position();
		//alert(rowpos.top);
		/*alert($('#table_catalogo tr:last').css('height'));
		alert($('#table_catalogo >tbody >tr').length);*/

		//var numRows = $('#table_catalogo >tbody >tr').length;
		var numRows = $('#showdata >tr').length;
		var rowHeight = parseInt($('#table_catalogo tr:last').css('height'));

		//$('#catalogo').scrollTop(rowpos.top);	
		$('#catalogo').scrollTop((numRows-1) * rowHeight);	
		//-----------------------------------------------------	
	}

	function obtener_dventatemp_id_desde_boton(boton)
	{
		return boton.parent().parent().children(".td-idproducto").children(".dventatemp_id").val()
	}

	function borrarDetalleVentaTemp(boton)
	{
		var data;
		var correcto = 0;

		var dventatemp_id = obtener_dventatemp_id_desde_boton(boton);

		data = "dventatemp_id=" + dventatemp_id;


		$.ajax({
			type: 	'ajax',
			method: 'post',
			url: 	'venta/borrarDetalleVentaTemp',
			data: 	data,
			async: 	false,
			dataType: 'json',
			success: function(data) {
				correcto = data[0].correcto;
				if(correcto == 1)
				{
					boton.parent().parent().remove();
					obtenerTotal();
				}
			},
			error:function() {
				alert('No se pudo quitar el Producto de la venta actual');
			}
		});

		return correcto;
	}

	function selVentaTemp(cveVenta) {
		var data;
		data = "cveVenta=" + cveVenta;
		data += "&solo_con_detalle=1";

		$.ajax({
			type:   'ajax',
			method: 'post',
			url:    'venta/selVentaTemp',
			data :  data,
			async:  false,
			dataType: 'json',

			success: function(data) {
				var html = '';
				var i;
				for(i=0;i<data.length; i++) {
					html +='<div class="btnVentaTemp" data-cveventa='+ data[i].cveVenta +' style="position:relative;width:48%;float:left;border:1px solid #e0e0e0;height:100px">'+
					data[i].cveVenta+
					'</div>';
				}
				$('#ventastemp').html(html);
			},
			error: function() {
				alert('No se pudieron cargar los datos');
			}
		});
	}	

	function guardarVenta()
	{
		var data;

		var cveVentaTemp = $('#cveVenta').val();

		data = "cveVentaTemp=" + cveVentaTemp;

		$.ajax({
			type: 	'ajax',
			method: 'post',
			url: 	'venta/guardarVenta',
			data: 	data,
			async: 	false,
			dataType: 'json',
			success: function(data) {
				alert('Venta guardada exitosamente: ' + data[0].cveVentaNueva);
				$('#modal-confirmarguardarventa').modal('hide');
				$('#modal-guardarventa').modal('hide');
				limpiarVenta();
			},
			error:function() {
				alert('No se pudo guardar la venta actual');
			}
		});
	}

	function limpiarVenta()
	{
		$('#cveVenta').val('');
		$('#tipoVenta').val('');
		$('#showdata tr').remove();
		$('#total').text('');
		$('#product_buttons').empty();
		crearVentaTemp();
	}