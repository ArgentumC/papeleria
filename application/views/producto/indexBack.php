<script src="<?php echo base_url('assets/js/venta_productos.js') ?>"></script>
<h1>Productos</h1>

<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#catalogo" aria-controls="catalogo" role="tab" data-toggle="tab">Catálogo</a></li>
    <li role="presentation"><a href="#registro" aria-controls="registro" role="tab" data-toggle="tab">Registro</a></li>
  </ul>

    <div class="row">
      <div class="col-md-5">
        <form id="formCapturaProd" action="<?php echo base_url() ?>producto/agregarProducto" method="post" class="form-horizontal">
          <div class="form-group">
            <input type="text" class="form-control" name="txtCaptura" id="campo_captura"></input>
          </div>
        </form>
      </div>
      
    </div>
  <!-- Tab panes -->
  <div class="tab-content">
      <table style="width:100%">
        <thead class="table table-hover" >
          <th style="width:40%;height:40px">Descripción</th>
          <th>Tipo Producto</th>
          <th><center>Acciones</center></th>
        </thead>    
      </table>  
    <div role="tabpanel" class="tab-pane active" id="catalogo" style="height:300px;overflow: auto">
      <table class="table table-hover">
        <tbody>
          <?php foreach($catalogoProductos as $producto) { ?>
          <tr>
            <td style="width:40%"><?php echo $producto->nombreproducto; ?></td>
            <td><?php echo $producto->tipoproducto; ?></td>
            <td>
              <center>
              <a href="<?= base_url('producto/delete').'/'.$producto->idproducto ?>" title="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                <a href="<?= base_url('producto/edit').'/'.$producto->idproducto ?>" title="Editar"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
              </center>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <div role="tabpanel" class="tab-pane" id="registro">
      <div class="row">
        <div class="col-md-5">
          <form method="POST" action="<?php echo base_url('producto/insert') ?>">
            <div class="form-group">
              <br>
              <label for="tipo_producto">Producto</label>
              <select class="form-control" name="selTipo_producto" id="tipo_producto">
                <?php foreach($selTipo_Producto as $tipo_producto) { ?>
                <option value="<?php echo $tipo_producto->id_tipo_producto?>"><?php echo $tipo_producto->tipo_producto ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="nombre_comun">Descripción</label>
              <input type="text" name="txtDescripcion" class="form-control" id="descripcion" placeholder="Escriba la Descripción del Producto">
            </div>  
            <button type="submit" class="btn btn-primary">Registrar Producto</button>
          </form>          
        </div>
        <div class="col-md-7">
        </div>        
      </div>

    </div>
  </div>

</div>
