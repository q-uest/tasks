
<?php

class reg_error extends CI_Controller {

	public function index() {

		
		$data['main_view'] = "view_errors";
		$this->load->view('layout/main',$data);

	}
	


}
?>

