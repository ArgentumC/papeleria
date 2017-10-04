var lineaEdicion;

var correcto_edit_tipo_producto;
var correcto_txtNombre;
var correcto_marca;
var correcto_unidad;

$(document).ready(function() {
	showAllProductos();
	showAllTipoProducto();
	showAllMarca();
	showAllUnidad();

	ocultarMensajesError();

	$('#campo_captura').keydown(function(e) {
		if (e.keyCode == 13) {
			e.preventDefault();
			showAllProductos();
		}
	});	

	$(document).on('change',"#tipo_producto",function() {
		showAllProductos();
	});

	$(document).on('click','.linkEditarProducto',function() {
		$('#funcionEdicion').val("U");

		$('#tituloEditarProducto').text('Editar Producto');
		//alert($(this).data("idproducto"));
		lineaEditar = $(this).parent().parent();
		editProducto($(this).data("idproducto"));
	});

	$(document).on('click','#btnNuevo',function() {
		$('#funcionEdicion').val("C");
		$('#tituloEditarProducto').text('Nuevo Producto');
		iniciaPantallaEdicion();
	});

	// Habilitar / Deshabilitar campo de IVA según selección de opción
	/*$(document).on('click','#rbAplicaIVA[value=1]',function() {
		$('#txtAplicaIVAPorc').prop('disabled',false);
	});

	$(document).on('click','#rbAplicaIVA[value=0]',function() {
		$('#txtAplicaIVAPorc').prop('disabled',true);
	});*/
	//----------------------------------------------------------------

	// Recalcula Precio de Venta a partir de cambios en los campos relacionados
	$(document).on('keyup','#txtPrecioCompra',function() {
		CalculaPrecioVenta();
	});

	$(document).on('keyup','#txtAplicaIVAPorc',function() {
		if($('#rbAplicaIVA').val() == "0" || ($('#rbAplicaIVA').val() == "1" && $('#txtPorcIVA').val() != ""))
		{
			CalculaPrecioVenta();
		}
	});	

	$(document).on('keyup','#txtPorcAdicional',function() {
		if($('#txtPorcAdicional').val() != "")
		{
			CalculaPrecioVenta();
		}
	});	
	//----------------------------------------------------------------

	$(document).on('change','#txtPrecioVentaPieza',function() {
		$('#txtPrecioVentaPieza').val(parseFloat($('#txtPrecioVentaPieza').val()).toFixed(2));
	});	

	$(document).on('change','#txtPrecioVentaPaquete',function() {
		$('#txtPrecioVentaPaquete').val(parseFloat($('#txtPrecioVentaPaquete').val()).toFixed(2));
	});		


	$(document).on('click','#btnGuardar',function() {
		estableceValoresDefault();

		if(validarTodo()) {
			var resultado = confirm('¿Confirma guardar el Producto descrito actualmente?');

			if(resultado) {
				switch($('#funcionEdicion').val())
				{
					case "C": crearProducto();
							break;
					case "U": actualizarProducto();
							break;
				}			
			}
		}
	});

	$('#edit_tipo_producto').focusout(function () {
		validar_edit_tipo_producto();
	});

	$(document).on('change','#edit_tipo_producto',function () {
		validar_edit_tipo_producto();
	});	


	$('#txtNombre').focusout(function () {
		validar_txtNombre();
	});	

	$('#edit_marca').focusout(function () {
		validar_marca();
	});	

	$(document).on('change','#edit_marca',function () {
		validar_marca();
	});		

	$('#edit_unidad').focusout(function () {
		validar_unidad();
	});			

	$(document).on('change','#edit_unidad',function () {
		validar_unidad();
	});		
});

function estableceValoresDefault()
{
	if($('#txtUnidPaquete').val() == '') { $('#txtUnidPaquete').val(0) }
	if($('#txtPrecioCompra').val() == '') { $('#txtPrecioCompra').val(0) }
	if($('#txtPorcAdicional').val() == '') { $('#txtPorcAdicional').val(0) }
	if($('#txtAplicaIVAPorc').val() == '') { $('#txtAplicaIVAPorc').val(0) }
	if($('#txtPrecioCalculado').val() == '') { $('#txtPrecioCalculado').val(0) }
	if($('#txtPrecioVentaPieza').val() == '') { $('#txtPrecioVentaPieza').val(0) }
	if($('#txtPrecioVentaPaquete').val() == '') { $('#txtPrecioVentaPaquete').val(0) }
}

function validarTodo()
{
	var validar = true;

	if(!validar_txtNombre()) { validar = false; } 
	if(!validar_edit_tipo_producto()) { validar = false; }
	if(!validar_marca()) { validar = false; }
	if(!validar_unidad()) { validar = false; }
	if(!validar_nombreDefault()) { validar = false; }

	return validar;
}

function validar_edit_tipo_producto()
{
	if($('#edit_tipo_producto').val() == "0") {
		$('#error_tipo_producto').show();
		correcto_edit_tipo_producto = false;
	}
	else
	{
		$('#error_tipo_producto').hide();
		correcto_edit_tipo_producto = true;
	}

	return correcto_edit_tipo_producto;
}

function validar_marca()
{
	if($('#edit_marca').val() == "0") {
		$('#error_marca').show();
		correcto_edit_marca = false;
	}
	else
	{
		$('#error_marca').hide();
		correcto_edit_marca = true;
	}

	return correcto_edit_marca;
}

function validar_unidad()
{
	if($('#edit_unidad').val() == "0") {
		$('#error_unidad').show();
		correcto_edit_unidad = false;
	}
	else
	{
		$('#error_unidad').hide();
		correcto_edit_unidad = true;
	}

	return correcto_edit_unidad;
}

function validar_txtNombre()
{
	if($('#txtNombre').val() == "") {
		$('#error_nombre').show();
		correcto_txtNombre = false;
	}
	else
	{
		$('#error_nombre').hide();
		correcto_txtNombre = true;
	}

	return correcto_txtNombre;
}

function validar_nombreDefault()
{
	var validarNombreDefault  = $('#rbNombre[value="U"]').prop('checked') || $('#rbNombre[value="P"]').prop('checked');

	return validarNombreDefault;
}

function ocultarMensajesError()
{
	$('#error_tipo_producto').hide();
	$('#error_nombre').hide();
	$('#error_marca').hide();
	$('#error_unidad').hide();

	correcto_edit_tipo_producto = false;
	correcto_txtNombre = false;
	correcto_marca = false;
	correcto_unidad = false;
}


function crearProducto()
{
	var data = $('#formProducto').serialize();

	$.ajax({
		type: 	'ajax',
		method: 'post',
		url: 	'producto/createProducto',
		data: 	data,
		async: 	false,
		dataType: 'json',
		success: function(data) {
			alert('Producto registrado satisfactoriamente.');
			$('#modal-editarproducto').modal('hide');
			//-- Actualiza valores editados del producto en el grid principal
			showAllProductos();
		},
		error:function() {
			alert('No se pudo registrar la información del Producto');
		}
	});	
}

function actualizarProducto()
{
	var data = $('#formProducto').serialize();

	$.ajax({
		type: 	'ajax',
		method: 'post',
		url: 	'producto/updateProducto',
		data: 	data,
		async: 	false,
		dataType: 'json',
		success: function(data) {
			$('#modal-editarproducto').modal('hide');
			//-- Actualiza valores editados del producto en el grid principal
			lineaEditar.find('.linkEditarProducto').text($('#txtNombre').val());
		},
		error:function() {
			alert('No se pudo actualizar la información del Producto');
		}
	});
}

function CalculaPrecioVenta()
{
	var TasaIVAApl = 0;
	var precioCalculado = 0;


	if($('#txtPrecioCompra').val() != "" && $('#txtPorcAdicional').val() != "" && ($('#rbAplicaIVA').val() == "0" || ($('#rbAplicaIVA').val() == "1" && $('#txtPorcIVA').val() != "")))
	{
		if($('#txtAplicaIVAPorc').val() != "") {
			TasaIVAApl = parseFloat($('#txtAplicaIVAPorc').val());
		}
	}

	precioCalculado = parseFloat($('#txtPrecioCompra').val()) * (1 + parseFloat(TasaIVAApl) / 100) * (1 + parseFloat($('#txtPorcAdicional').val()) / 100)

	if(!isNaN(precioCalculado)) {
		$('#txtPrecioCalculado').val(precioCalculado.toFixed(2));
	}
	else {
		$('#txtPrecioCalculado').val('');
	}

	
}

function showAllProductos() {
	var data;

	data = 'cadena=' + $('#campo_captura').val();
	data += '&cveTipoProducto=' + $('#tipo_producto').val();

	$.ajax({
		type:'ajax',
		url: 'producto/showAllProductos',
		async: false,
		dataType: 'json',
		method: 'post',
		data: data,

		success: function(data) {
			var html = '';
			var i;
			for(i=0;i<data.length; i++) {
				html += generarLineaProducto(data[i]);
			}
			$('#showdata').html(html);
			$('#catalogo').scrollTop(0);	
		},
		error: function() {
			alert('No se pudieron cargar los datos');
		}
	});
}

function generarLineaProducto(data)
{
	var html = "";

	html += '<tr>'+
		'<td style="width:4%">'+
		'<a href="javascript":;" class="btn btn-xs btn-danger">Inactivar</a>'+
		'</td>'+				
		'<td style="width:7%">'+data.cveProducto+'</td>'+
		'<td style="width:31%"><a class="linkEditarProducto" href="#" data-idproducto = '+data.idproducto+' data-toggle="modal" data-target="#modal-editarproducto">'+data.nombreproducto+'</a></td>'+
		'<td style="width:7%">'+data.tipoproducto+'</td>'+
		'<td style="width:9%">'+data.marca+'</td>'+		
		'<td style="width:6%">'+data.codigomarchand+'</td>'+		
		'<td style="width:6%">'+data.codigo1+'</td>'+		
		'<td style="width:6%">'+data.codigo2+'</td>'+		
		'<td style="width:5%">'+data.act+'</td>'+	
		'<td style="width:6%;text-align:right">'+data.precioventapieza+'</td>'+
		'<td style="width:6%;text-align:right">'+data.precioventapaquete+'</td>'+
		'<td style="width:7%">'+data.status+'</td>'+
		'</tr>';
	return html;
}


function showAllTipoProducto() {
	var data;

	$.ajax({
		type:'ajax',
		url: 'tipo_producto/showAllTipoProducto',
		async: false,
		dataType: 'json',

		success: function(data) {
			var html = '';
			var i;
			html = '<option value="0"></option>'

			for(i=0;i<data.length; i++) {
				html +=
                '<option value="'+ data[i].cveTipoProducto +'">'+data[i].TipoProducto+'</option>'
			}
			$('#tipo_producto').html(html);
			$('#edit_tipo_producto').html(html);
		},
		error: function() {
			alert('No se pudieron cargar los datos');
		}
	});
}

function showAllMarca() {
	var data;

	$.ajax({
		type:'ajax',
		url: 'marca/showAllMarca',
		async: false,
		dataType: 'json',

		success: function(data) {
			var html = '';
			var i;
			html = '<option value="0"></option>'

			for(i=0;i<data.length; i++) {
				html +=
                '<option value="'+ data[i].cveMarca +'">'+data[i].Marca+'</option>'
			}
			$('#edit_marca').html(html);
		},
		error: function() {
			alert('No se pudieron cargar los datos');
		}
	});
}

function showAllUnidad() {
	var data;

	$.ajax({
		type:'ajax',
		url: 'unidad/showAllUnidad',
		async: false,
		dataType: 'json',

		success: function(data) {
			var html = '';
			var i;
			html = '<option value="0"></option>'

			for(i=0;i<data.length; i++) {
				html +=
                '<option value="'+ data[i].cveUnidad +'">'+data[i].Unidad+'</option>'
			}
			$('#edit_unidad').html(html);
		},
		error: function() {
			alert('No se pudieron cargar los datos');
		}
	});
}

function editProducto(idproducto) {
	var data;

	data = "idproducto=" + idproducto

	$.ajax({
		type:'ajax',
		url: 'producto/editProducto',
		async: false,
		dataType: 'json',
		method : 'post',
		data : data,

		success: function(data) {
			cargarDatosProducto(data[0]);
		},
		error: function() {
			alert('No se pudieron cargar los datos');
		}
	});
}

function cargarDatosProducto(data)
{
	$('#idproducto').val(data.idproducto);
	$('#txtNombre').val(data.nombreproducto);
	$('#txtNombrePaquete').val(data.nombreproductopaquete);

	$('#edit_tipo_producto').val(data.cveTipo);
	$('#edit_marca').val(data.cveMarca);
	$('#edit_unidad').val(data.cveUnidad);
	$('#txtPrecioCompra').val(parseFloat(data.preciocompra).toFixed(2));
	$('#txtCodigoBarras').val(data.codigobarras);
	$('#rbCodigo[value='+data.opcioncodigo+']').prop('checked','checked');
	$('#rbNombre[value='+data.unidadDefault+']').prop('checked','checked');
	$('#txtCodMarchand').val(data.CodigoMarchand);
	$('#txtUnidPaquete').val(data.UnidadesPaquete);

	var valorIVA = parseInt(data.IVA);

	$('#rbAplicaIVA[value="'+ (valorIVA > 0 ? 1 : 0).toString() +'"]').prop('checked','checked')

	/*if(parseInt(data.IVA) == 0)
		$('#txtAplicaIVAPorc').prop('disabled',true);*/

	$('#txtAplicaIVAPorc').val(data.IVA);
	$('#txtPorcAdicional').val(data.PorcUtil);

	$('#txtConsecutivo').val(data.ConsProducto);

	CalculaPrecioVenta();
}

function iniciaPantallaEdicion()
{
	limpiarPantallaEdicion();
	ocultarMensajesError();
}

function limpiarPantallaEdicion()
{
	$('input[type=text]').val('');
	$('input[type=radio]').prop('checked',false);
	$('select').prop('selectedIndex',0);
	$('#txtPorcAdicional').val("0");
	$('#txtPorcIVA').val("0");
}