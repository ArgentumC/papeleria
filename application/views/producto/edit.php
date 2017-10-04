<form method="POST" action="<?php echo base_url('producto/update') ?>">
	<?php foreach ($datosProducto as $producto) { ?>
	<input type="hidden" name="txtId_producto" value="<?php echo $producto->id_producto ?>">
	<div class="form-group">
		<br>
		<label for="tipo_producto">Tipo de Producto</label>
		<?php
		$lista = array();
		foreach ($selTipo_Producto as $tipo_producto) {
			$lista[$tipo_producto->id_tipo_producto] = $tipo_producto->tipo_producto;
		}

		echo form_dropdown('selTipo_Producto', $lista, $producto->id_tipo_producto,'class="form-control"');
		?>
	</div>
	<div class="form-group">
		<label for="nombre_comun">Descripción</label>
		<input type="text" name="txtDescripcion" class="form-control" id="descripcion" value="<?php echo $producto->descripcion ?>"
	</div>  
	<br>
	<?php } ?>
	<button type="submit" class="btn btn-primary">Registrar Producto</button>
</form>  