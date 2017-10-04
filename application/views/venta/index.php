<script src="<?php echo base_url('assets/js/venta_index.js') ?>"></script>
<style>
  .tableGuardar {
    font-size:20px;
  }
  .tableGuardar td {
    height:40px;
  }

</style>
<h1>Punto de Venta</h1>

<div>
  <!-- Nav tabs -->
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
  <div class="row">
    <div class="tab-content col-md-7">
        <table style="width:100%">
          <thead class="table table-hover" >
            <th style="width:10%;height:40px">
            <th style="width:15%" colspan="2">Unidad</th>
            <th style="width:51%">Descripción</th>
            <th style="width:10%;text-align: center">Cantidad</th>
            <th style="width:4%;text-align: center"></th>
            <th style="width:10%;text-align: center">Precio</th>
          </thead>    
        </table>  
      <div role="tabpanel" class="tab-pane active" id="catalogo" style="height:400px;overflow-y:scroll">
        <table class="table table-hover" id="table_catalogo">
          <tbody id="showdata">

          </tbody>
        </table>
        
      </div>
      <div id="total" style="width:100px;position:relative;left:85%;background-color:green;height:30px;text-align:right;padding-right:5px;line-height:30px;color:white">
        
      </div>
    </div>
    <div class="col-md-5">
      <div style="width:100%;height:35px;float:left">
        <button class="btn btn-primary btn-block">Hola</button>
      </div>
      <div style="width:100%;height:400px;float:left" id="product_buttons">
        
      </div>
      <div style="width:50%;height:35px;float:left">
        <button class="btn btn-primary btn-block"><</button>
      </div>    
      <div style="width:50%;height:35px;float:left">
        <button class="btn btn-primary btn-block">></button>
      </div>        

    </div>
  </div>

  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-temp" id="btnVerTemporales">Ver Temporales</button>
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-guardarventa" id="btnAbrirGuardarVenta">Guardar Venta</button>

  <div class="modal fade" id="modal-temp">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class ="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Ventas temporales</h3>
        </div>
        <div class="modal-body" id="ventastemp" style="height:320px">
          
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Ventana GUARDAR VENTA-->
  <div class="modal fade" id="modal-guardarventa">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class ="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Guardar Venta</h3>
        </div>
        <div class="modal-body" style="height:200px">
          <table class="tableGuardar">
            <tr>
              <td style="width:50%">Total:</td>
              <td id="lblTotal" style="text-align: right"></td>
            </tr>
            <tr>
              <td>Cliente paga:</td>
              <td><input type="text" id="txtRecibido" style="text-align: right" class="form-control" /></td>
            </tr>
            <tr>
              <td>Cambio:</td>
              <td id="lblCambio" style="text-align: right"></td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-confirmarguardarventa" id="btnGuardarVenta">Guardar</a>
          <a href="#" class="btn btn-default" data-dismiss="modal">Cerrar</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Termina Ventana Guardar Venta-->

  <!-- Ventana CONFIRMAR GUARDAR VENTA-->
  <div class="modal fade" id="modal-confirmarguardarventa">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class ="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Confirmar</h3>
        </div>
        <div class="modal-body" style="height:200px">
          <h2>¿Confirma guardar venta?</h2>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-primary" id="btnConfirmarGuardarVenta">Confirmar</a>
          <a href="#" class="btn btn-default" data-dismiss="modal">Cerrar</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Termina Ventana Confirmar Guardar Venta-->  

  <input type="hidden" id="cveVenta">
  <input type="hidden" id="tipoVenta">
</div>
