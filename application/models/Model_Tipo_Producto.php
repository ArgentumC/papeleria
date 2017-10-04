<?php 
	class Model_Tipo_Producto extends CI_Model {
		function __construct() {
			parent::__construct();
			$this->load->database();
		}

		public function showAllTipoProducto() {
			$query = $this->db->query("SELECT * from cattipoproducto order by TipoProducto");

			return $query->result();
		}
	}
?>