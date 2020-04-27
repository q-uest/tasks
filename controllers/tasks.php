<?php

class Tasks extends CI_Controller
{




public function cre_task($id)
{
	#echo "----cre_task()...userdata[task]=".$this->session->userdata('project_id');
	#echo "----cre_task()...task_data=-".$this->session->userdata('task_data')[0]->project_id;
	#$data['task_project_id']=$this->session->userdata('task_data')[0]->project_id;

	
	$data['main_view'] = "tasks/task_view";
	$this->load->view('layout/main',$data);
}	

public function validate_task() 
	{
	
		$this->form_validation->set_rules('name','Task Name','trim|required|min_length[3]');
		$this->form_validation->set_rules('description','Task Desscription','trim|required|min_length[3]');
		$this->form_validation->set_rules('due_date','Due Date','required');



		if($this->form_validation->run() == FALSE)
		{

			$valerr = array(
			'errors' => $this->form_validation->validation_errors());

			$this->session->set_flashdata('valerr');
			redirect('tasks\cre_task');
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
			}
			
			
			

			redirect('projects/display/'.$this->session->userdata('project_data')->id);
		

		}


	#public function list_tasks($project_id) {

	#	$task = $this->task_model->get_list_tasks($project_id);

	#}
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


}


?>