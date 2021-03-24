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
	$query=$this->db->query("select `lvl`, `id`, `task_name`, `task_body`, `assignee`, `parent_task_id`, `due_date`, `created_on`, `approved`, `status`, `project_id`, `group_id`, `username`, `last_loggedin`, `state`, `latest_update`, Date_format(`latestupd_datetime`,'%d-%b-%Y %H:%i') as 'latestupd_datetime',`alert`,`depends_on_task`,`started_date` from tasks_hierarch_view where 
	project_id='$project_id' AND username='$username' ");
	
#	echo  "num_rows=".$query->num_rows();

	return $query->result_array();


}

public function get_dot_values($taskid) {

####
# get depends_on_tasks column value for the given taskid
###########

echo "firing get_dot_values";


$this->db->select('project_id,id,depends_on_task');
$this->db->like('depends_on_task', $taskid);
	
$this->db->from('tasks');
$query=$this->db->get();

echo  "num_rows=".$query->num_rows();
$val=$query->result_array();
$err="FALSE";
for ($i=0;$i<sizeof($val);$i++)
{
	$dot=explode(",",$val[$i]["depends_on_task"]);
	$res[$i]=$this->task_model->check_deptask_stat($val[$i]['project_id'],$dot);
	echo "<br/>taskid=".$val[$i]["id"];
	$taskid=$val[$i]["id"];
	echo "<br/>size of result array=".sizeof($res[$i]);
	if (sizeof($res[$i])==0)
	{
		$stat=$this->db->query("update tasks set status=1 where id='$taskid' ");
		echo "upd stat=".$stat;
		if ($stat !== 1)
			$err="TRUE";
		

	}

}
	return $err;

}

public function check_deptask_stat($id,$deptasks)
{

##########
# Usage:
#  Check the statuses of the listed tasks in depends_on_task column, 
#  if they are "NOT COMPLETED". 
#  'deptasks' is an array with the dependent_tasks
#################################


	$this->db->where('project_id', $id);
	$this->db->where_in('id', $deptasks);
	
	# find if any row has status other than "complete"
	
	$this->db->where('status!=', 3);
	$this->db->select('id,status');
	$this->db->from('tasks');
	$query=$this->db->get();

	echo  "<br/>num_rows=".$query->num_rows();
	return $query->result_array();

}
public function populate_dependson_tasks($project_id,$username,$id) 
{
	echo "populate_dependson_tasks project_id=".$project_id." username=".$username;
	$query=$this->db->query("select  `id`, `task_name`, `task_body`,   `due_date` from tasks_hierarch_view where 
	 project_id='$project_id' AND username='$username' AND parent_task_id !=0 AND  id !='$id'");
	return $query->result_array();


}

public function get_parent_status($pt_taskid)
{
	####
	# Check if master task is completed
	##########

	$rows=$this->db->query("select id,status from tasks where 
		id='$pt_taskid' and status=3");
	echo "num_rows=".$rows->num_rows();
	return $rows->num_rows();

}

public function upd_tskdepon($id,$newlst)
{
	$stat=$this->db->query("update tasks set depends_on_task='$newlst' where id='$id'");
	return($stat);
}


public function set_tskstat_completed($id)
{
	$stat=$this->db->query("update tasks set status=3 where id='$id'");
	return($stat);
}



public function db_approve_task($taskid)
{

	$stat=$this->db->query("update tasks set approved=0,status=1 where id='$taskid'");
	return $stat;
}



public function check_duedate($ddate,$parddt)
{

	echo "</br>from check_duedate....ddate=".$ddate.' parddt='.$parddt;
	$res=$this->db->query(
		"SELECT 'true' where str_to_date('$ddate','%Y-%m-%d')> str_to_date('$parddt','%d-%b-%Y')");
	#$result=$this->db->get();

	$numrows=$res->num_rows();
	echo "<br>check_duedate....numrows=".$numrows;
	#echo "result=".$res;
	return $numrows;
}


public function check_duedate_gt_ted($ddate,$ted)
{

	echo "<br><br>from check_duedate....ddate=".$ddate.' ted='.$ted;
	$res=$this->db->query(
		"SELECT 'true' where str_to_date('$ddate','%Y-%m-%d')>str_to_date('$ted','%Y-%m-%d')");
	#$result=$this->db->get();

	$numrows=$res->num_rows();
	echo "<br>check_duedate_gt_ted....numrows=".$numrows;
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
	"select 'true' where str_to_date('$ddate','%Y-%m-%d')<curdate()");
	$numrows=$res->num_rows();
	echo "<br>curdate check of numrows=".$numrows." ddate=".$ddate;
	return $numrows;
}


public function delete_tasks($taskslis)
 {
 	$this->db->where_in('id',$taskslis);
 	$delete=$this->db->delete('tasks');
 	return $delete?true:false;

 }


public function chk_opn_chldtsk($id)
{
	########
	# Check if there are any child tasks which are not closed yet
	##################

	$query=$this->db->query("select id from tasks where parent_task_id='$id' and status !=3");

	echo "</br>The unclosed & unscheduled rows=".$query->num_rows()." for ".$id;
	return $query->num_rows();

}

public function db_fetch_task($id)

{

	$query=$this->db->query("SELECT `id`, `task_name`, `task_body`, `parent_task_id`, `userid`, `approved`, `status`, `project_id`, date_format(`due_date`,'%d-%b-%Y') as `due_date`,`groupid`,`clo_comments`,`latest_update`,`latestupd_datetime`,`depends_on_task`,`tentative_start_date`,`tentative_due_date`,
		`started_date` FROM tasks where id='$id'");

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


public function db_set_inprogress($pt_taskid)
{
	$stat=$this->db->query("update tasks set status=2,started_date=CURDATE() where id='$pt_taskid' and status !=2");
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
        `tasks`.`tasks`.`id` AS `id`
    FROM
        `tasks`.`tasks`
    WHERE
        `tasks`.`tasks`.`parent_task_id` = '$taskid' and `tasks`.`tasks`.`groupid`='$grpid' and  ((`tasks`.`tasks`.`due_date`=str_to_date('$olddt','%d-%b-%Y'))
        or (`tasks`.`tasks`.`due_date`>str_to_date('$newdt','%Y-%m-%d')))
    UNION ALL
SELECT
    `st`.`id` AS `id`
  FROM
    (
        `tasks`.`tasks` `st`
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
        `tasks`.`tasks`.`id` AS `id`
    FROM
        `tasks`.`tasks`
    WHERE
        `tasks`.`tasks`.`parent_task_id` = '$taskid' and `tasks`.`tasks`.`groupid`='$grpid' 
    UNION ALL
SELECT
    `st`.`id` AS `id`
  FROM
    (
        `tasks`.`tasks` `st`
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
