<?php 

class Marca extends CI_Controller {
	function __construct () {
		parent::__construct();
		$this->load->model('Model_Marca');
	}

	public function index() {
	}

	public function showAllMarca() {
		$result = $this->Model_Marca->showAllMarca();
		echo json_encode($result);			
	}
}