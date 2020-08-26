<?php


class Task_model extends CI_Model 
{



	public function ins_task($data)
	{

		$insert_task=$this->db->insert('tasks',$data);
		$insert_id=$this->db->insert_id();
		echo "task_model...status=".$data['status'];
		return $insert_id;
	}


public function get_list_tasks($project_id,$username) 
{

	$condition="(project_id='$project_id' AND username='$username')";
	$this->db->where($condition);
	$list_task=$this->db->get('tasks_hierarch_view');
	#echo "num rows=".$list_task->num_rows();
	return $list_task->result();


}

public function db_approve_task($taskid)
{

	$stat=$this->db->query("update tasks set approved=0,status=1 where id='$taskid'");
	return $stat;
}



public function check_duedate($ddate,$parddt)
{

	echo "from check_duedate....ddate=".$ddate.' parddt='.$parddt;
	$res=$this->db->query(
		"SELECT 'true' where str_to_date('$ddate','%Y-%c-%d')<= str_to_date('$parddt','%Y-%c-%d')");
	#$result=$this->db->get();
	$numrows=$res->num_rows();
	echo "<br>numrows=".$numrows;
	#echo "result=".$res;
	return $numrows;
}

public function check_duedate_curdate($ddate)
{

	$res=$this->db->query(
	"select 'true' where str_to_date('$ddate','%Y-%c-%d')>=curdate()");
	$numrows=$res->num_rows();
	echo "<br>curdate check of numrows=".$numrows;
	return $numrows;
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
	return $task->result_array();



}


public function db_del_task($id)
{

	$this->db->where('id',$id);
	$stat=$this->db->delete('tasks');
	return $stat;
}

public function db_upd_task($task)
{
	echo "<br>db_upd_task fired....ID=".$this->session->userdata['task']['task_id'].' '.$task['due_date'];
	
	$this->db->where('id',$this->session->userdata['task']['task_id']);
	$stat=$this->db->update('tasks',$task);
	return $stat;
}


public function get_tasks($taskid,$grpid)
{
	echo "get_tasks model fired";

	$sql="WITH
    recursive task_main AS(
    SELECT
        1 AS `lvl`,
        `users`.`tasks`.`id` AS `id`,
        `users`.`tasks`.`parent_task_id` AS `parent_task_id`,
        `users`.`tasks`.`due_date` AS `due_date`,
        `users`.`tasks`.`project_id` AS `project_id`,
        `users`.`tasks`.`groupid` AS `group_id`
    FROM
        `users`.`tasks`
    WHERE
        `users`.`tasks`.`parent_task_id` = '$taskid' and `users`.`tasks`.`groupid`='$grpid'
    UNION ALL
SELECT
    `p`.`lvl` + 1 AS `lvl+1`,
    `st`.`id` AS `id`,
    `st`.`parent_task_id` AS `parent_task_id`,
    `st`.`due_date` AS `due_date`,
    `st`.`project_id` AS `project_id`,
    `p`.`group_id` AS `group_id`
FROM
    (
        `users`.`tasks` `st`
            JOIN `task_main` `p`
    )
WHERE
    `st`.`parent_task_id` = `p`.`id` and `st`.`groupid`='$grpid'
)
SELECT
    `task_main`.`lvl` AS `lvl`,
    `task_main`.`id` AS `id`,
    `task_main`.`parent_task_id` AS `parent_task_id`,
    DATE_FORMAT(`task_main`.`due_date`, '%e-%b-%Y') AS `due_date`,
    `task_main`.`project_id` AS `project_id`,
    `task_main`.`group_id` AS `group_id`
 FROM
    `task_main`
ORDER BY
    `task_main`.`group_id` ";

    $resarr=$this->db->query($sql);

    return $resarr->result_array();

}
}



?>