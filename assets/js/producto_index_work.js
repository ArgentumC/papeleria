$(document).ready(function() {
	$('#campo_captura').keydown(function(e) {
		if (e.keyCode == 13) {
			e.preventDefault();
			agregarProducto();
		}
	});

	showAllProductos();
	var rowpos = $('#table_catalogo tr:last').position();

	$('#catalogo').scrollTop(rowpos.top);	
});


function showAllProductos() {
	$.ajax({
		type:'ajax',
		url: 'producto/showAllProductos',
		async:false,
		dataType: 'json',

		success: function(data) {
			var html = '';
			var i;
			for(i=0;i<data.length; i++) {
				html +='<tr>'+
				'<td>'+data[i].nombreproducto+'</td>'+
				'<td>'+data[i].tipoproducto+'</td>'+
				'<td>'+
				'<a href="javascript":;" class="btn btn-info">Edit</a>'+
				'<a href="javascript":;" class="btn btn-danger">Delete</a>'+
				'</td>'+
				'</tr>';
			}
			$('#showdata').html(html);
		},
		error: function() {
			alert('No se pudieron cargar los datos');
		}
	});
}	

function agregarProducto()
{
	var url = $('#formCapturaProd').attr('action');
	var data = $('#formCapturaProd').serialize();


	$.ajax({
		type: 	'ajax',
		method: 'post',
		url: 	url,
		data: 	data,
		async: 	false,
		dataType: 'json',
		success: function(response) {
			if(response.success) {
				location.reload();
			}
			else
				alert('Error');
		},
		error: function() {
			alert('Error al agregar el producto')
		}
	});
}