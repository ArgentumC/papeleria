<h1>Tipos de Producto</h1>
<form method="POST" action="<?php base_url('producto/insert')">
  <div class="form-group">
    <label for="tipo_producto">Tipo de Producto</label>
    <input type="text" class="form-control" name="txtTipo_producto" id="tipo_producto" placeholder="Escriba el tipo">
  </div>
  <div class="form-group">
    <label for="nombre_comun">Nombre común</label>
    <input type="text" name="txtNombre_comun" class="form-control" id="nombre_comun" placeholder="Escriba el Nombre común">
  </div>  
  <button type="submit" class="btn btn-default">Registrar Tipo de Producto</button>
</form>