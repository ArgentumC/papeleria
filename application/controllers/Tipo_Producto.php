<?php 

class Tipo_Producto extends CI_Controller {
	function __construct () {
		parent::__construct();
		$this->load->model('Model_Tipo_Producto');
	}

	public function index() {
		/*$data['contenido'] = "tipo_producto/index";
		$data['selTipo_Producto'] = $this->Model_Tipo_Producto->selTipo_Producto();
		$this->load->view('plantilla',$data);*/
	}

	public function showAllTipoProducto() {
		$result = $this->Model_Tipo_Producto->showAllTipoProducto();
		echo json_encode($result);			
	}
}