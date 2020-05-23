<?php


class Task_model extends CI_Model 
{



	public function ins_task($data)
	{

		$insert_task=$this->db->insert('tasks',$data);
		$insert_id=$this->db->insert_id();
		
		return $insert_id;
	}



public function get_list_tasks($project_id) 
{


	$this->db->where('project_id',$project_id);
	$list_task=$this->db->get('tasks');
	#echo "num rows=".$list_task->num_rows();
	return $list_task->result();


}

public function delete_tasks($taskslis)
 {
 	$this->db->where_in('id',$taskslis);
 	$delete=$this->db->delete('tasks');
 	return $delete?true:false;

 }


public function db_fetch_task($id)

{

	$this->db->where('id',$id);
	$task=$this->db->get('tasks');

	echo "num rows=".$task->num_rows();
	echo "<br>";
	var_dump($task->result());
	return $task->result();



}


public function db_del_task($id)
{

	$this->db->where('id',$id);
	$stat=$this->db->delete('tasks');
	return $stat;
}

public function db_upd_task($task)
{
	
	$this->db->where('id',$this->session->userdata('task_id'));
	$stat=$this->db->update('tasks',$task);
	return $stat;
}



}

?>