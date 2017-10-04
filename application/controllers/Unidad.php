<?php 

class Unidad extends CI_Controller {
	function __construct () {
		parent::__construct();
		$this->load->model('Model_Unidad');
	}

	public function index() {
	}

	public function showAllUnidad() {
		$result = $this->Model_Unidad->showAllUnidad();
		echo json_encode($result);			
	}
}