<?php

class Home extends CI_Controller {

	public function index() {


		#echo "Firing home\index";

		if($this->session->userdata('logged_in'))
		{
			#echo "List the users projects here....";
			#echo "home.php user_id=".$this->session->userdata('user_id');
			$data['projects'] = $this->project_model->list_user_projects($this->session->userdata('user_id'));

		}

		
		$data['main_view'] = "home_view";
		$this->load->view('layout/main',$data);

	}
	


}
?>
