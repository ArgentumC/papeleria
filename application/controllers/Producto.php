<?php
	class Producto extends CI_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('Model_Tipo_Producto');
			$this->load->model('Model_Producto');
		}

		public function index()
		{
			$data['contenido'] = "producto/index";
			/*$data['selTipo_Producto'] = $this->Model_Tipo_Producto->selTipo_Producto();

			$data['catalogoProductos'] = $this->Model_Producto->selCatalogo();*/
			$this->load->view('plantilla',$data);
		}

		public function insert()
		{
			$datos = $this->input->post();

			if(isset($datos)) {
				$selTipo_Producto = $datos['selTipo_producto'];
				$txtDescripcion = $datos['txtDescripcion'];
				$this->Model_Producto->insertProducto($selTipo_Producto,$txtDescripcion);
				redirect('index');
			}
		}

		public function delete($id=NULL)
		{
			if($id != NULL)
			{
				$this->Model_Producto->deleteProducto($id);
				redirect('');
			}
		}

		public function edit($id=NULL)
		{
			if($id!=NULL)
			{
				$data['contenido'] = 'producto/edit';
				$data['selTipo_Producto'] = $this->Model_Tipo_Producto->selTipo_Producto();
				$data['datosProducto'] = $this->Model_Producto->editProducto($id);
				$this->load->view('plantilla', $data);
			}
			else
			{
				redirect('');
			}
		}

		public function update() {
			$datos = $this->input->post();

			if(isset($datos)) {
				$txtId_producto = $datos["txtId_producto"];
				$txtId_tipo_producto = $datos["selTipo_Producto"];
				$txtDescripcion = $datos["txtDescripcion"];
				$this->Model_Producto->updateProducto($txtId_producto,$txtId_tipo_producto,$txtDescripcion);

				redirect('');
			}
		}

		public function agregarProducto() {
			$result = $this->Model_Producto->agregarProducto();

			$msg['success'] = false;
			if($result) {
				$msg['success'] = true;
			}

			echo json_encode($msg);
		}

		public function showAllProductos() {
			$datos = $this->input->post();

			if(isset($datos))
			{
				$cadena = $datos['cadena'];
				$cveTipoProducto = $datos['cveTipoProducto'];
				$result = $this->Model_Producto->showAllProductos($cadena,$cveTipoProducto);
				echo json_encode($result);				
			}
		}

		public function editProducto() {
			$datos = $this->input->post();

			if(isset($datos))
			{
				$idproducto = $datos['idproducto'];
				$result = $this->Model_Producto->editProducto($idproducto);
				echo json_encode($result);				
			}
		}	

		public function updateProducto() {
			$datos = $this->input->post();

			if(isset($datos))
			{
				$idproducto = $datos['idproducto'];
				$nombreproducto = $datos['txtNombre'];
				$nombrepaquete = $datos['txtNombrePaquete'];
				$cveTipo = $datos['edit_tipo_producto'];
				$unidadDefault = $datos['rbNombre'];
				$cveMarca = $datos['edit_marca'];
				$cveUnidad = $datos['edit_unidad'];
				$preciocompra = $datos['txtPrecioCompra'];
				$precioventapieza = $datos['txtPrecioVentaPieza'];
				$precioventapaquete = $datos['txtPrecioVentaPaquete'];
				$codigobarras = $datos['txtCodigoBarras'];
				$opcioncodigo = $datos['rbCodigo'];
				$codigoMarchand = $datos['txtCodMarchand'];
				$Codigo1 = $datos['txtCodigo1'];
				$Codigo2 = $datos['txtCodigo2'];
				$IVA = $datos['txtAplicaIVAPorc'];
				$PorcUtil = $datos['txtPorcAdicional'];
				$UnidadesPaquete = $datos['txtUnidPaquete'];


				$result = $this->Model_Producto->updateProducto($idproducto,$nombreproducto,$nombrepaquete,
					$cveTipo,$unidadDefault,$cveMarca,$cveUnidad,$preciocompra,$precioventapieza,$precioventapaquete,$codigobarras,
					$opcioncodigo,$codigoMarchand,$Codigo1,$Codigo2,$IVA,$PorcUtil,$UnidadesPaquete);
				echo json_encode($result);				
			}
		}		

		public function createProducto() {
			$datos = $this->input->post();

			if(isset($datos))
			{
				$nombreproducto = $datos['txtNombre'];
				$nombrepaquete = $datos['txtNombrePaquete'];
				$cveTipo = $datos['edit_tipo_producto'];
				$unidadDefault = $datos['rbNombre'];
				$cveMarca = $datos['edit_marca'];
				$cveUnidad = $datos['edit_unidad'];
				$preciocompra = $datos['txtPrecioCompra'];
				$precioventapieza = $datos['txtPrecioVentaPieza'];
				$precioventapaquete = $datos['txtPrecioVentaPaquete'];				
				$codigobarras = $datos['txtCodigoBarras'];
				$opcioncodigo = $datos['rbCodigo'];
				$codigoMarchand = $datos['txtCodMarchand'];
				$Codigo1 = $datos['txtCodigo1'];
				$Codigo2 = $datos['txtCodigo2'];
				$IVA = $datos['txtAplicaIVAPorc'];
				$PorcUtil = $datos['txtPorcAdicional'];
				$UnidadesPaquete = $datos['txtUnidPaquete'];


				$result = $this->Model_Producto->createProducto($nombreproducto,$nombrepaquete,
					$cveTipo,$unidadDefault,$cveMarca,$cveUnidad,$preciocompra,$precioventapieza,$precioventapaquete,
					$codigobarras,$opcioncodigo,$codigoMarchand,$Codigo1,$Codigo2,$IVA,$PorcUtil,$UnidadesPaquete);
				echo json_encode($result);				
			}
		}				
	}
?>