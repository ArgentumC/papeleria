<?php 
	class Model_Venta extends CI_Model {
		function __construct() {
			parent::__construct();
			$this->load->database();
		}

		// Insertar Venta Temporal
		public function guardarVenta($cveVentaTemp) {
			$sql = "CALL spVenta_InsVenta('P',".$cveVentaTemp.")";

			$query = $this->db->query($sql);

			return $query->result();
		}

		/*public function selVentaTemp($cveVenta,$solo_con_detalle) {
			$sql = "CALL spVenta_SelVentaTemp(0,1)";

			$query = $this->db->query($sql);

			if($query->num_rows() > 0) {
				return $query->result();
			}else{
				return false;
			}
		}		*/
	}
?>