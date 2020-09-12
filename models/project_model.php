<?php

class Project_model extends CI_Model {


	public function get_projects() 
	{

		$query = $this->db->get('projects');

		return $query->result();





	}

	public function get_project($id) 
	{

		$this->db->where('id',$id);
		$query = $this->db->get('projects');
		echo "No of row=".$query->num_rows();
		return $query->row();


	}


	public function list_user_projects($user_id)
	{

#		echo "model list_user_projects() user_id".$user_id;

		$this->db->where('project_user_id',$user_id);
		$query = $this->db->get('projects');
		return $query->result();
	}

	public function create_project($data)
	{
		$insert_data = $this->db->insert('projects',$data);
		return $insert_data;



	}

	public function update_project($data)
	{


		#$this->db->update('projects',$data,'id='.$this->session->userdata('project_id'));
		$this->db->where('id',$this->session->userdata('project_id'));
		$this->db->update('projects',$data);
		return $this->db->trans_status();
		#return $query;

	}

	public function del_project($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('projects');
		return $this->db->trans_status();
	}


	

}