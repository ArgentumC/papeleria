<?php
class Venta extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Model_DetalleVentaTemp');
		$this->load->model('Model_VentaTemp');
		$this->load->model('Model_Venta');
	}

	public function index()
	{
		$data['contenido'] = "venta/index";
			/*$data['selTipo_Producto'] = $this->Model_Tipo_Producto->selTipo_Producto();

			$data['catalogoProductos'] = $this->Model_Producto->selCatalogo();*/
			$this->load->view('plantilla',$data);
		}

/*
		public function insert()
		{
			$this->Model_Producto->insertProducto($selTipo_Producto,$txtDescripcion);
			//return result
		}

		public function delete($id=NULL)
		{
			if($id != NULL)
			{
				$this->Model_Producto->deleteProducto($id);
				//return result
			}
		}

		public function update() {
			if(isset($datos)) {
				$this->Model_Producto->updateProducto($txtId_producto,$txtId_tipo_producto,$txtDescripcion);

				//return result
			}
		}

		public function agregarProducto() {
			$result = $this->Model_Producto->agregarProducto();

			$msg['success'] = false;
			if($result) {
				$msg['success'] = true;
			}

			echo json_encode($msg);
		}*/

		public function buscarProducto() {
			$datos = $this->input->post();

			if(isset($datos)) {
				$cadena = $datos['txtCaptura'];
				$idproducto = $datos['idproducto'];

				$result = $this->Model_DetalleVentaTemp->buscarProducto($cadena,$idproducto);

				echo json_encode($result);
			}
		}		

		public function selDetalleVentaTemp() {
			$datos = $this->input->post();
			if(isset($datos)) {
				$cveVenta = $datos['cveVenta'];
				$result = $this->Model_DetalleVentaTemp->selDetalleVentaTemp($cveVenta);
				echo json_encode($result);
			};
		}

		public function insertarDetalleVentaTemp() {
			$datos = $this->input->post();

			if(isset($datos)) {
				$cveVenta = $datos['cveVenta'];
				$idproducto = $datos['idproducto'];

				$result = $this->Model_DetalleVentaTemp->insertarDetalleVentaTemp($cveVenta,$idproducto);
				echo json_encode($result);	
			}
		}

		public function borrarDetalleVentaTemp() {
			$datos = $this->input->post();

			if(isset($datos)) {
				$dventatemp_id = $datos['dventatemp_id'];

				$result = $this->Model_DetalleVentaTemp->borrarDetalleVentaTemp($dventatemp_id);
				echo json_encode($result);
			}
		}

		public function crearVentaTemp() {
			$result = $this->Model_VentaTemp->crearVentaTemp();
			echo json_encode($result);	
		}		

		public function selVentaTemp() {
			$datos = $this->input->post();
			if(isset($datos)) {
				$cveVenta = $datos['cveVenta'];
				$solo_con_detalle = $datos['solo_con_detalle'];
				$result = $this->Model_VentaTemp->selVentaTemp($cveVenta,$solo_con_detalle);
				echo json_encode($result);
			};
		}	

		public function guardarVenta() {
			$datos = $this->input->post();

			if(isset($datos)) {
				$cveVentaTemp = $datos['cveVentaTemp'];

				$result = $this->Model_Venta->guardarVenta($cveVentaTemp);
				echo json_encode($result);	
			}
		}	

		public function alternarUnidadPartida() {
			$datos = $this->input->post();

			if(isset($datos)) {
				$dventatemp_id = $datos['dventatemp_id'];

				$result = $this->Model_DetalleVentaTemp->alternarUnidadPartida($dventatemp_id);
				echo json_encode($result);	
			}
		}		

		public function sumarUnidad() {
			$datos = $this->input->post();

			if(isset($datos)) {
				$dventatemp_id = $datos['dventatemp_id'];
				$cantidadSumar = $datos['cantidadSumar'];

				$result = $this->Model_DetalleVentaTemp->sumarUnidad($dventatemp_id,$cantidadSumar);
				echo json_encode($result);	
			}
		}	
	}
	?>