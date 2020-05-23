<?php

class Tasks extends CI_Controller
{
public function __construct() 
	{
	parent::__construct();

		
		
		if(!$this->session->userdata('logged_in'))
		{

			$this->session->set_flashdata('no_access',"<h2>Not Logged in...!</h2>");
			redirect('home/index');
			

		}

 	}




public function cre_task($id)
{
	#echo "----cre_task()...userdata[task]=".$this->session->userdata('project_id');
	#echo "----cre_task()...task_data=-".$this->session->userdata('task_data')[0]->project_id;
	#$data['task_project_id']=$this->session->userdata('task_data')[0]->project_id;

	$add_task_func="false";
	$data['main_view'] = "tasks/task_view";
	$data['project_data']=$this->project_model->get_project($id);
	$this->session->set_userdata($data);
	echo $this->session->userdata('project_data')->id;
	$this->load->view('layout/main',$data);
}	

public function js_add_task($id)
{

	#this is called from Javascript to insert task records 

		#	$data['main_view'] = "tasks/task_view";
			#$project_data(1) {[0] => {['id'] => 34]}};

		$data['project_data']=$this->project_model->get_project($id);

		#print_r($_SESSION);
		#var_dump($this->session);

		$add_task_func="true";
        #echo "project_data=".$data['project_data']->id ;
		
		$this->session->set_userdata($data);
		
		#echo $this->session->userdata('project_data')->id;
		
		#echo "project_data".$this->session->userdata('project_data')->id;
		#echo "project_id=".$a;
		$this->load->view('tasks/js_insert_task',$data);

}

public function validate_task() 
{
	
		$this->form_validation->set_rules('name','Task Name','trim|required|min_length[3]');
		$this->form_validation->set_rules('description','Task Desscription','trim|required|min_length[3]');
		$this->form_validation->set_rules('due_date','Due Date','required');



		if($this->form_validation->run() == FALSE)
		{
			#echo "form errors occurred";
			$taskerr = array(
			'taskerrors' => validation_errors());

			echo $taskerrors;
			$this->session->set_flashdata($taskerr);
			if ($add_task_func=="false")
			{
			
			$url="tasks/cre_task/".$this->session->userdata('project_data')->id;
			}
			else
			{
				$url="tasks/js_add_task/".$this->session->userdata('project_data')->id;
			
			}	
			redirect($url);
		}

		else

		{

			$task = array(
				'project_id' =>$this->session->userdata('project_data')->id,
				'task_name' => $this->input->post('name'),
				'task_body' => $this->input->post('description'),
				'due_date' => $this->input->post('due_date')
			);


			$insert_id=$this->task_model->ins_task($task);



			if($insert_id)
			{
				echo "successfully inserted";
				$this->session->set_flashdata('task_inserted','<p class="bg-success">The Task has been added </p>');
				?>
				<script>
				
				window.close();

				</script>
				<?php
			}
			
			
			
			if(isset($add_task_func))
			{
				echo "add_Task";
			}
			// else
			// {	
			// 	redirect('projects/display/'.$this->session->userdata('project_data')->id);
			// }
			#$this->output->set_output("done at php");

		}
}

public function list_tasks($project_id) {
		$resultSet=Array();
		$task = $this->task_model->get_list_tasks($project_id);
			//var_dump($task);
			foreach($task as $t)
			{
				$resultSet[]= $t;
			}
		
		echo json_encode($resultSet);
		

	}


public function del_loftasks()
{	
	#elements=1,2,3
	#$elem="46,50";
	echo "firing del_loftasks.......! ";
	

	$elem=$_POST['elements'];
	$tasks = explode(',', $elem);
	#echo "typeof tasks=".$tasks;
	
	
	
	$tasksres = $this->task_model->delete_tasks($tasks);
	//echo "elements[0]=".$elements[0];
	//$data['main_view']='tasks\delete_views';
	//$this->load->view('layout\main.php',$data);



}

public function del_task($id)
{

	$xs=$this->task_model->db_del_task($id);

	if($xs)
			{
				$this->session->set_flashdata('task_deleted','<p class="bg-success"> The Task has been deleted </p>');
			}

	redirect('projects/display/'.$this->session->userdata('project_data')->id);

	
}


public function upd_task($id)
{

	$data['task']=$this->task_model->db_fetch_task($id);

	$data['project_id'] = $data['task'][0]->project_id;
	$task['task_id'] = $data['task'][0]->id;
	$this->session->set_userdata($task);

	$data['main_view']='tasks\edit_view';
	$this->load->view('layout\main.php',$data);


	

	$task = array(
				'task_name' => $data['task'][0]->task_name,
				'task_body' => $data['task'][0]->task_body,
				'due_date' 	=> $data['task'][0]->due_date
			);


	$xs=$this->task_model->db_upd_task($task);

	if($xs)
			{
				$this->session->set_flashdata('task_updated','<p class="bg-success"> The Task has been updated </p>');
			}

	#redirect('projects/display/'.$this->session->userdata('project_data')->id);

	
}


public function validate_upd_task()

{

		$this->form_validation->set_rules('name','Task Name','trim|required|min_length[3]');
		$this->form_validation->set_rules('description','Task Desscription','trim|required|min_length[3]');
		$this->form_validation->set_rules('due_date','Due Date','required');



		if($this->form_validation->run() == FALSE)
		{

			$valerr = array(
			'errors' => $this->form_validation->validation_errors());

			$this->session->set_flashdata('valerr');
			redirect('tasks/upd_task/'.$data['task']->id);
		}

		else

		{

			$task = array(
				'task_name' => $this->input->post('name'),
				'task_body' => $this->input->post('description'),
				'due_date' => $this->input->post('due_date')
			);


			$upd_status=$this->task_model->db_upd_task($task);



			if($upd_status)
			{
				echo "successfully Updated";
				$this->session->set_flashdata('task_updated','<p class="bg-success">The Task has been updated </p>');
			}
			
			
			

			redirect('projects/display/'.$this->session->userdata('project_data')->id);
		

		}
}

function view_tasks($id)
{



	$data['task']=$this->task_model->db_fetch_task($id);

	$data['project_id'] = $data['task'][0]->project_id;
	$task['task_id'] = $data['task'][0]->id;
	$this->session->set_userdata($task);

	$data['main_view']='tasks\edit_view';
	$this->load->view('layout\main.php',$data);
	

	

	$task = array(
				'task_name' => $data['task'][0]->task_name,
				'task_body' => $data['task'][0]->task_body,
				'due_date' 	=> $data['task'][0]->due_date
			);




}


}


?>