<?php


class Task_model extends CI_Model 
{



	public function ins_task($data)
	{

		$insert_task=$this->db->insert('tasks',$data);
		$insert_id=$this->db->insert_id();
		#echo "task_model...status=".$data['status'];
		return $insert_id;
	}

public function upd_root_task($taskid)
{
	$stat=$this->db->query("update tasks set groupid='$taskid' where id='$taskid'");
	return $stat;

}

public function get_list_tasks($project_id,$username) 
{
	$query=$this->db->query("select `lvl`, `id`, `task_name`, `task_body`, `assignee`, `parent_task_id`, `due_date`, `created_on`, `approved`, `status`, `project_id`, `group_id`, `username`, `last_loggedin`, `state`, `latest_update`, Date_format(`latestupd_datetime`,'%d-%b-%Y %H:%i') as 'latestupd_datetime' from tasks_hierarch_view where 
	project_id='$project_id' AND username='$username' ");
	#$condition="(project_id='$project_id' AND username='$username')";
	#$this->db->where($condition);
	#$list_task=$this->db->get('tasks_hierarch_view');
	#echo "num rows=".$list_task->num_rows();
	return $query->result_array();


}

public function db_approve_task($taskid)
{

	$stat=$this->db->query("update tasks set approved=0,status=1 where id='$taskid'");
	return $stat;
}



public function check_duedate($ddate,$parddt)
{

	#echo "<br><br>from check_duedate....ddate=".$ddate.' parddt='.$parddt;
	$res=$this->db->query(
		"SELECT 'true' where str_to_date('$ddate','%d/%c/%Y')> str_to_date('$parddt','%d-%b-%Y')");
	#$result=$this->db->get();

	$numrows=$res->num_rows();
	#echo "<br>check_duedate....numrows=".$numrows;
	#echo "result=".$res;
	return $numrows;
}

public function get_currdate()
{
	$query=$this->db->query("select date_format(curdate(),'%d/%m/%Y') as today");
	return $query->result_array();
}

public function check_duedate_curdate($ddate)
{

	$res=$this->db->query(
	"select 'true' where str_to_date('$ddate','%d-%b-%Y')<=curdate()");
	$numrows=$res->num_rows();
	#echo "<br>curdate check of numrows=".$numrows;
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

	$query=$this->db->query("SELECT `id`, `task_name`, `task_body`, `parent_task_id`, `userid`, `approved`, `status`, `project_id`, date_format(`due_date`,'%d-%b-%Y') as `due_date`,`groupid`,`clo_comments`,`latest_update`,`latestupd_datetime` FROM tasks where id='$id'");

	#$this->db->select("`id`, `task_name`, `task_body`, `parent_task_id`, `userid`, `approved`, `status`, `project_id`, `due_date`, `groupid`");

	#$this->db->where('id',$id);
	#$task=$this->db->get('tasks');

	#echo "num rows=".$task->num_rows();
	#echo "<br>";
	#var_dump($task->result());
	return $query->result_array();



}


public function db_del_task($id)
{

	$this->db->where('id',$id);
	$stat=$this->db->delete('tasks');
	return $stat;
}

public function chg_duedate_fmt($duedt)
{
	$query=$this->db->query("select str_to_date('$duedt','%d/%m/%Y') as ddate");
	return $query->result_array();
}

public function chg_duedate_def_datetype($duedt)
{
	$query=$this->db->query("select date_format(str_to_date('$duedt','%d-%b-%Y'),'%d/%m/%Y') as ddate");

	return $query->result_array();
}

public function chg_duedate_fmt_forupd($duedt)
{
	$query=$this->db->query("select date_format(str_to_date('$duedt','%Y-%m-%d'),'%d/%m/%Y') as ddate");

	return $query->result_array();
}


public function db_upd_task($task)
{
	#echo "<br>db_upd_task fired....ID=".$this->session->userdata['task']['task_id'].' '.$task['due_date']."approved=".$task['approved'];
	
	$this->db->where('id',$this->session->userdata['task']['task_id']);
	$stat=$this->db->update('tasks',$task);
	return $stat;
}

public function db_upd_ddateofsubtasks($chldtasks,$due_date)
{
	#echo "chldtask id".$chldtasks[0]['id'];
	$duedate=array("due_date"=>$due_date);
	
	$where=array();
	foreach ($chldtasks as $task)
	{
    	array_push($where, $task['id']);
		#echo "TASK=".$task['id'];
	}

#	$cond=array('id'=>$chldtasks['id']);
	$this->db->where_in('id',$where);
	$stat=$this->db->update('tasks',$duedate);
	return $stat;

}



public function get_tasks($taskid,$grpid,$olddt,$newdt)
{
	#echo "<br>get_tasks model fired...taskid=".$taskid."grpid=".$grpid."olddt=".$olddt."newdt".$newdt;

	$sql="WITH
    recursive task_main AS(
    SELECT
        `users`.`tasks`.`id` AS `id`
    FROM
        `users`.`tasks`
    WHERE
        `users`.`tasks`.`parent_task_id` = '$taskid' and `users`.`tasks`.`groupid`='$grpid' and  ((`users`.`tasks`.`due_date`=str_to_date('$olddt','%d-%b-%Y'))
        or (`users`.`tasks`.`due_date`>str_to_date('$newdt','%Y-%m-%d')))
    UNION ALL
SELECT
    `st`.`id` AS `id`
  FROM
    (
        `users`.`tasks` `st`
            JOIN `task_main` `p`
    )
WHERE
    `st`.`parent_task_id` = `p`.`id` and `st`.`groupid`='$grpid'  and ((`st`.`due_date`=str_to_date('$olddt','%d-%b-%Y')) or (`st`.`due_date`>str_to_date('$newdt','%Y-%m-%d')) )
)
SELECT
    `task_main`.`id` AS `id`
  FROM
    `task_main`
 ";

    $resarr=$this->db->query($sql);

    return $resarr->result_array();

}

public function del_task($taskid,$grpid)
{
	#echo "<br>get_tasks model fired...taskid=".$taskid."grpid=".$grpid."olddt=".$olddt."newdt".$newdt;

	$sql="WITH
    recursive task_main AS(
    SELECT
        `users`.`tasks`.`id` AS `id`
    FROM
        `users`.`tasks`
    WHERE
        `users`.`tasks`.`parent_task_id` = '$taskid' and `users`.`tasks`.`groupid`='$grpid' 
    UNION ALL
SELECT
    `st`.`id` AS `id`
  FROM
    (
        `users`.`tasks` `st`
            JOIN `task_main` `p`
    )
WHERE
    `st`.`parent_task_id` = `p`.`id` and `st`.`groupid`='$grpid'  
)
SELECT
    `task_main`.`id` AS `id`
  FROM
    `task_main`
 ";

    $resarr=$this->db->query($sql);

echo "list of task to be deleted";
    
    foreach($resarr->result_array() as $t)
			{
				$resultSet[]= $t['id'];
				echo "id=".$t['id'];
			}
		
	if ($resarr->num_rows() > 0)
	{
		echo $resultSet[0];
    	$this->db->where_in('id', $resultSet);
    	$stdelete = $this->db->delete('tasks');
    	echo "stdelete=".$stdelete;
    #return $delete?true:false;
    }
    $this->db->where_in('id', $taskid);
    $mtdelete = $this->db->delete('tasks');
    echo "mtdelete=".$mtdelete;
    return $mtdelete?true:false;
    #return $resarr->result_array();
    
}


}



?>