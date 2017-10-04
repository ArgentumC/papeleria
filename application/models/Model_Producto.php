<?php 
	include('ChromePhp.php');
	ChromePhp::log('Qué pedo');
	class Model_Producto extends CI_Model {
		function __construct() {
			parent::__construct();
			$this->load->database();
		}

		public function showAllProductos($cadena,$cveTipoProducto) {
			$idproducto = 0;
			$pagina = 1;
			$prod_pagina = 100;
			//$cadena = "boligrafo";

			$sql = "CALL spProd_SelProductos('".$cadena."',".$idproducto.",".$cveTipoProducto.",".$pagina.",".$prod_pagina.")";

			ChromePhp::log($sql);
			$query = $this->db->query($sql);

			if($query->num_rows() > 0) {
				return $query->result();
			}else{
				return false;
			}
		}

		public function editProducto($idproducto)
		{
			$sql = "CALL spProd_SelProductoDetalle(".$idproducto.",'')";

			$query = $this->db->query($sql);

			if($query->num_rows() > 0) {
				return $query->result();
			}else{
				return false;
			}
		}

		public function updateProducto($idproducto,$nombreproducto,$nombrepaquete,
				$cveTipo,$unidadDefault,$cveMarca,$cveUnidad,$preciocompra,$precioventapieza,$precioventapaquete,$codigobarras,
				$opcioncodigo,$codigoMarchand,$Codigo1,$Codigo2,$IVA,$PorcUtil,$UnidadesPaquete) {

			/*$idproducto = 5688;
			$nombreproducto = 'BOLIGRAFO KILOMETRICO C/TAPA AZUL';
			$nombrepaquete = '';
			$cveTipo=5;
			$unidadDefault = 'U';
			$cveMarca = 119;
			$cveUnidad = 1;
			$preciocompra = 19.5;
			$codigobarras = '';
			$opcioncodigo = 'L';
			$codigoMarchand = '';
			$Codigo1 = '';
			$Codigo2 = '';
			$IVA = 0;
			$PorcUtil = 40;
			$UnidadesPaquete = 0;		*/		

			$sql = "CALL spProd_UpdActualizarProducto(".$idproducto.",".
				"'".$nombreproducto."','".$nombrepaquete."',".
				$cveTipo.",'".$unidadDefault."',".$cveMarca.",".$cveUnidad.",".$preciocompra.",".
				$precioventapieza.",".$precioventapaquete.",'".$codigobarras."',".
				"'".$opcioncodigo."','".$codigoMarchand."','".$Codigo1."','".$Codigo2."',".$IVA.",".$PorcUtil.",".
				$UnidadesPaquete.")";	
			ChromePhp::log($sql);			

			$query = $this->db->query($sql);

			return $query->result();
		}	

		public function createProducto($nombreproducto,$nombrepaquete,
				$cveTipo,$unidadDefault,$cveMarca,$cveUnidad,$preciocompra,$precioventapieza,$precioventapaquete,$codigobarras,
				$opcioncodigo,$codigoMarchand,$Codigo1,$Codigo2,$IVA,$PorcUtil,$UnidadesPaquete) {

			

			$sql = "CALL spProd_InsCrearProducto('".$nombreproducto."','".$nombrepaquete."','P',".
				$cveTipo.",'".$unidadDefault."',".$cveMarca.",".$cveUnidad.",".$preciocompra.",".$precioventapieza.",".
				$precioventapaquete.",'".$codigobarras."',".
				"'".$opcioncodigo."','".$codigoMarchand."','".$Codigo1."','".$Codigo2."',".$IVA.",".$PorcUtil.",".
				$UnidadesPaquete.")";	
			ChromePhp::log($sql);


			$query = $this->db->query($sql);

			return $query->result();
		}			
	}
?>