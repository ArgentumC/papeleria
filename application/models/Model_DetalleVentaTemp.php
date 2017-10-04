<?php 
	class Model_DetalleVentaTemp extends CI_Model {
		function __construct() {
			parent::__construct();
			$this->load->database();
		}

		// Función para insertar Producto
/*		public function insertProducto($cveTipo,$nombreproducto)
		{
			$arrayDatos = array(
					'cveTipo' => $cveTipo,
					'nombreproducto' => $nombreproducto
				);

			$this->db->insert('catproductos',$arrayDatos);
		}*/


/*		public function deleteProducto($id)
		{
			$this->db->where('idproducto',$id);
			$this->db->delete(array('logcambiosprecio','catproductos'));
		}*/

/*		public function updateProducto($idproducto,$cveTipo,$nombreproducto) {
			$array = array(
				'idproducto' => $idproducto,
				'cveTipo' => $cveTipo,
				'nombreproducto' => $nombreproducto
				);

			$this->db->where('idproducto',$idproducto);
			$this->db->update('catproductos',$array);
		}*/

/*		public function agregarProducto() {
			$field = array(
				'cveTipo' => 1,
				'nombreproducto' => $this->input->post('txtCaptura')
			);

			$this->db->insert('catproductos',$field);

			if($this->db->affected_rows() > 0) {
				return true;
			}
			else {
				return false;
			}
		}*/

		public function selDetalleVentaTemp($cveVenta) {
			$sql = "CALL spVenta_SelDetalleVentaTemp('".$cveVenta."',0)";

			$query = $this->db->query($sql);

			if($query->num_rows() > 0) {
				return $query->result();
			}else{
				return false;
			}
		}

		public function buscarProducto($cadena,$idproducto) {
			$sql = "CALL spProd_SelProductos('".$cadena."',".$idproducto.",0,1,16)";

			$query = $this->db->query($sql);

			return $query->result();
		}

		public function insertarDetalleVentaTemp($cveVenta,$idproducto) {
			$sql = "CALL spVenta_InsDetalleVentaTemp(".$cveVenta.",".$idproducto.")";

			$query = $this->db->query($sql);

			return $query->result();
		}

		public function borrarDetalleVentaTemp($dventatemp_id) {
			$sql = "CALL spVenta_BorrarDetalleVentaTemp(".$dventatemp_id.")";

			$query = $this->db->query($sql);

			return $query->result();
		}

		public function alternarUnidadPartida($dventatemp_id) {
			$sql = "CALL spVenta_UpdAlternarUnidadPartida(".$dventatemp_id.")";

			$query = $this->db->query($sql);

			return $query->result();
		}		

		public function sumarUnidad($dventatemp_id,$cantidadSumar) {
			$sql = "CALL spVenta_UpdSumarCantidad(".$dventatemp_id.",".$cantidadSumar.")";

			$query = $this->db->query($sql);

			return $query->result();
		}		
	}
?>