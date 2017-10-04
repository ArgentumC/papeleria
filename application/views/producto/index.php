<script src="<?php echo base_url('assets/js/producto_index.js') ?>"></script>
<h1>Productos</h1>

<style>
  #cuerpo * {
    font-size:12px;
  }

  #tabla_captura td {
    width:7%;
    height:42px;
  }

  #lineaTit td {
    height:5px;
  }

  .lblRadioButton {
    padding-left:7px
  }

  .mensajeError {
    color:red;
    font-size:4em;
    font-weight:bold;
  }
</style>

<div>

  <!-- Nav tabs -->
  <!--<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#catalogo" aria-controls="catalogo" role="tab" data-toggle="tab">Catálogo</a></li>
    <li role="presentation"><a href="#registro" aria-controls="registro" role="tab" data-toggle="tab">Registro</a></li>
  </ul>-->

    <div class="row">
      <div class="col-md-12">
        <form id="formCapturaProd" action="<?php echo base_url() ?>producto/agregarProducto" method="post" class="form-horizontal">
          <div class="form-group col-md-1" >
            <label for="tipo_producto">Buscar</label>
          </div>

          <div class="form-group col-md-4" >
            <input type="text" class="form-control" name="txtCaptura" id="campo_captura"></input>
          </div>
          <div class="form-group col-md-1" ></div>
          <div class="form-group col-md-1" >
            <label for="selTipo_producto">Tipo</label>
          </div>          
          <div class="form-group col-md-5" >
              <select class="form-control" id="tipo_producto">
                
              </select>          
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
    <div role="tabpanel" class="tab-pane active" id="catalogo" style="height:400px;overflow: auto">
      <table class="table table-hover" id="table_catalogo">
        <tbody id="showdata">

        </tbody>
      </table>
    </div>
    <br>
    <div class="row">
        <button class="btn btn-primary" id="btnNuevo" data-toggle="modal" data-target="#modal-editarproducto">Nuevo</button>
        <button class="btn btn-primary" id="btnGrupos">Ver/Editar Grupos</button>
        <button class="btn btn-primary" id="btnServicios">Definir Servicios</button> 
        <button class="btn btn-primary" id="btnServicios">Generar Lista</button>
    </div>    

    <div role="tabpanel" class="tab-pane" id="registro">
      <div class="row">
        <div class="col-md-5">
          <form method="POST" action="<?php echo base_url('producto/insert') ?>">
            <div class="form-group">
              <br>
              
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

  <!-- Ventana EDITAR PRODUCTO-->
  <div class="modal fade" id="modal-editarproducto">
    <div class="modal-dialog" style="width:85%">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class ="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title" id="tituloEditarProducto"></h3>
        </div>
        <div class="modal-body" id="cuerpo" style="height:446px">
          <form method="post" id="formProducto">
          <table style="width:100%;margin:auto" id="tabla_captura">
            <tr id="lineaTit">
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td colspan="2">
                <label for="selTipo_producto">Tipo</label>
              </td>
              <td colspan="3">
                <select  id="edit_tipo_producto" style="width:95%" name="edit_tipo_producto" autofocus tabindex="20">
                  
                </select>   
                <span id="error_tipo_producto" class="mensajeError">*</span>
              </td>
              <td></td>
              <td><label for="txtConsecutivo">Consecutivo</label></td>
              <td><input type=text  id="txtConsecutivo" name="txtConsecutivo" style="width:70%;text-align:center" readonly="true"></td>
              <td colspan="2"><label for="txtCodigoBarras">Código de Barras</label></td>
              <td colspan="3"><input type=text  id="txtCodigoBarras" name="txtCodigoBarras" maxlength="20"></td>              
              <td></td>
            </tr>
            <tr>
              <td colspan="2">
                <label for="txtNombre">Nombre</label>
              </td>
              <td colspan="5">
                <input type=text  id="txtNombre" name="txtNombre" style="width:95%" maxlength="300" tabindex="201"> 
                <span id="error_nombre" class="mensajeError">*</span>
              </td>
              <td><input type="radio" id="rbNombre" value="U" name="rbNombre"><label class="lblRadioButton">Default</label></input></td>
              <td></td>
              <td colspan="2">
                <input type="radio" id="rbCodigo" name="rbCodigo" value="L"><label class="lblRadioButton">Código legible</label></input>
              </td>
              <td colspan="3">
                <input type="radio" id="rbCodigo" name="rbCodigo" value="S"><label class="lblRadioButton">Sin código</label></input>
              </td>
              <td colspan="">
            </tr> 
            <tr>
              <td colspan="2">
                <label for="txtNombrePaquete">Nombre Paquete</label>
              </td>
              <td colspan="5">
                <input type=text  id="txtNombrePaquete" name="txtNombrePaquete" maxlength="300" style="width:95%"> 
              </td>
              <td><input type="radio" id="rbNombre" value="P" name="rbNombre"><label class="lblRadioButton">Default</label></input></td>
              <td></td>
              <td colspan="3">
                <input type="radio" id="rbCodigo" name="rbCodigo" value="N"><label class="lblRadioButton">Con código pero No legible</label></input>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <label for="txtUnidPaquete">Unidades p/Paquete</label>
              </td>
              <td colspan="1">
                <input type=text  id="txtUnidPaquete" name="txtUnidPaquete" style="width:95%;text-align: right"> 
              </td>
              <td colspan="4">
              </td>
              <td colspan="2">
                <label for="txtCodMarchand">Código Marchand</label>
              </td>
              <td>
                <input type=text  id="txtCodMarchand" name="txtCodMarchand" style="width:95%" maxlength="15"> 
              </td>
              <td colspan="2">
                <label for="txtCodFabricante">Código Fabricante</label>
              </td>
              <td>
                <input type=text  id="txtCodFabricante" name="txtCodFabricante" style="width:95%" maxlength="15"> 
              </td>              
            </tr>

            <tr>
              <td colspan="2">
                <label for="edit_marca">Marca</label>
              </td>
              <td colspan="3">
                <select  id="edit_marca" name="edit_marca" style="width:80%">
                  
                </select>   
                <span id="error_marca" class="mensajeError">*</span>
              </td>
              <td>
                <label for="edit_unidad">Unidad</label>
              </td>
              <td>
                <select  id="edit_unidad" name="edit_unidad" style="width:70%">
                  
                </select>  
                <span id="error_unidad" class="mensajeError">*</span>
              </td>
              <td colspan="2">
                <label for="txtCodigo1">Código 1</label>
              </td>
              <td>
                <input type=text id="txtCodigo1" name="txtCodigo1" style="width:95%" maxlength="15"> 
              </td>
              <td colspan="2">
                <label for="txtCodigo2">Código 2</label>
              </td>
              <td>
                <input type=text id="txtCodigo2" name="txtCodigo2" style="width:95%" maxlength="15"> 
              </td>                          
            </tr>  
            <tr>
              <td>
                <label for="txtGrupo">Grupo</label>
              </td>
            </tr>   
            <tr>
              <td colspan="2">
                <label for="txtPrecioCompra">Precio Compra</label>
              </td>
              <td >
                <input type="text" style="text-align: right;width:70%" id="txtPrecioCompra" name="txtPrecioCompra">
              </td>
              <td></td>
              <td colspan="2">
                <label for="txtPrecioCalculado">Precio calculado</label>
              </td>
              <td>
                <input type="text" id="txtPrecioCalculado" name="txtPrecioCalculado" style="text-align: right">
              </td>              
            </tr>       
            <tr>
              <td colspan="2">
                <label>Aplica IVA</label>
              </td>
              <td>
                <input type="radio" id="rbAplicaIVA" value="1" name="rbAplicaIVA">Sí</input>
                <input type="text" id="txtAplicaIVAPorc" name="txtAplicaIVAPorc" style="width:30%;text-align:right">%
              </td>
              <td><input type="radio" id="rbAplicaIVA" value="0" name="rbAplicaIVA">No</td>   
              <td colspan="2">
                <label for="txtPrecioVentaPieza">Precio Venta Pieza</label>
              </td>      
              <td>
                <input type="text" id="txtPrecioVentaPieza" name="txtPrecioVentaPieza" style="text-align: right">
              </td> 
            </tr>     
            <tr>
              <td colspan="2">
                <label for="txtPorcAdicional">Porc. Adicional</label>
              </td>
              <td>
                <input type="text" id="txtPorcAdicional" name="txtPorcAdicional" style="width:70%;text-align:right">%
              </td>
              <td colspan="1"></td>
              <td colspan="3">
                <label>Niveles de P. Venta Pieza</label>
              </td>
            </tr>   
            <tr>
              <td colspan="4"></td>
              <td colspan="2">
                <label for="txtPrecioVentaPaquete">Precio Venta Paquete</label>
              </td>
              <td>
                <input type="text" id="txtPrecioVentaPaquete" name="txtPrecioVentaPaquete"  style="text-align: right">
              </td>              
            </tr>             
          </table>
          <input type="hidden" id="idproducto" name="idproducto">
          <input type="hidden" id="funcionEdicion" name="funcionEdicion">
          </form>



        </div>
        <div class="modal-footer">
          <!--<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-confirmarguardarventa" id="btnGuardar">Guardar</a>-->
          <a href="#" class="btn btn-primary"  id="btnGuardar">Guardar</a>
          <a href="#" class="btn btn-default" data-dismiss="modal">Cerrar</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Termina Ventana Editar Producto-->
</div>
