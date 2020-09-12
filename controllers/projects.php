<?php


class Projects extends CI_Controller {

	public function __construct() 
	{
	parent::__construct();

		
		
		if(!$this->session->userdata('logged_in'))
		{

			$this->session->set_flashdata('no_access',"<h2>Not Logged in...!</h2>");
			redirect('home/index');
			


		}

 	}

	public function index() {
		
		# The below is fired after performing update against tasks 


		echo $this->session->flashdata('task_updated');
		echo $this->session->flashdata('task_inserted');
		echo $this->session->flashdata('task_deleted');
		
		$data['projects'] = $this->project_model->get_projects();

		$data['main_view'] = "projects\index";
		$this->load->view('layout/main', $data);


	}




	public function display($id) {

		$data['project_data'] = $this->project_model->get_project($id);

		echo "project_data[id]=".$data['project_data']->id;
		echo "username=".$this->session->userdata('username');
		$data['task_data'] = $this->task_model->get_list_tasks($data['project_data']->id,$this->session->userdata('username'));


		$this->session->set_userdata($data);

		$data['main_view'] = "projects\display";
		$this->load->view('layout/main', $data);


		
		#echo "task_project_id=".$this->session->userdata('task_project_id');
	}


	public function create() {

			#echo "this is create() ";
	
			$data['dml_op'] = 'I';
	    	$this->session->set_userdata($data);

	    	#echo "create() dml_op=".$this->session->userdata('dml_op');

			$data['main_view'] = "projects\create_proj";
			$this->load->view('layout/main',$data);



	}


	public function validate() 
	{	
		echo "this is projects\validate()";
		echo "dml_op=".$this->session->userdata('dml_op');
		$this->form_validation->set_rules('name', 'Project Name', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('description', 'Project Description', 'trim|required');

		echo "dml_op=".$this->session->userdata('dml_op');

		if ($this->form_validation->run() == FALSE )
		{

			$errdata = array(
				'projerr' => validation_errors('<p class="bg-danger">')
					      );

			$this->session->set_flashdata($errdata);

			
			echo "dml_op=".$this->session->userdata('dml_op');
			if ($this->session->userdata('dml_op') == 'I')
			{
				redirect('projects\create');

			}
			elseif ($this->session->userdata('dml_op') == 'U')
			{
					echo "this is update";
					echo "project_id=".$this->session->userdata('project_id');
	    			redirect('projects/upd_proj/'.$this->session->userdata('project_id'));
	    	}
			
		}
		else
		{
			echo "the record is valid;";
			if ($this->session->userdata('dml_op') == 'I')
		  	{

		  			echo "this is insert operation with valid rec";
		  			echo "user_id in projects.php=".$this->session->userdata('user_id');
					$data = array(
					'project_user_id'=> $this->session->userdata('user_id'),
					'project_name' => $this->input->post('name'),
					'project_body' => $this->input->post('description')
			         );

				
					if($this->project_model->create_project($data))
					{
						$this->session->set_flashdata('project_inserted','<p class="bg-danger">The project has been added</p>');
   						redirect('projects/index');	

					}

		   	}
			elseif ($this->session->userdata('dml_op') == 'U')
			{
		   		
		   		$data = array(
		   		'project_user_id'=> $this->session->userdata('user_id'),
				'project_name' => $this->input->post('name'),
				'project_body' => $this->input->post('description')
				  );
		   		if($this->project_model->update_project($data))
				{
					$this->session->set_flashdata('project_updated','<p class="bg-danger">The project has been updated</p>');
	   				redirect('projects/index');	

				}
			}

		}

	}
	
	    public function upd_proj($id) 
	    {
	    	echo "this is upd_proj;";
	    	$data['project_data'] = $this->project_model->get_project($id);
	    	$data['dml_op'] = 'U';
	    	$data['project_id'] = $data['project_data']->id;
			

	    	$this->session->set_userdata($data['dml_op']);

	    	$this->session->set_userdata($data);

	    	echo "project_id=".$data['project_id'];

			$data['main_view'] = 'projects\upd_proj';
	    	$this->load->view('layout\main',$data);
	    	

	    }

	 	   public function del_proj($id)
	 	    {

	    		$status = $this->project_model->del_project($id);

	    		if($status){

	    		$this->session->set_flashdata('project_deleted','<p class="bg-danger">The project has been deleted</p>');
	   					
	   			}
	    	
	    		redirect('projects/index');
				//$data['main_view'] = 'projects\index';
	    		//$this->load->view('layout\main',$data);
	    	

	    	}


}