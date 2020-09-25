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

	$data['add_task_func']="false";
	#$add_task_func="false";
	$data['main_view'] = "tasks/task_view";
	$data['project_data']=$this->project_model->get_project($id);
	$this->session->set_userdata($data);
	#echo $this->session->userdata('project_data')->id;
	$this->load->view('layout/main',$data);
}	


public function get_task($taskid) {
 $task=$this->task_model->db_fetch_task($taskid);
 $userid=$task[0]['userid'];
 #echo "from get_task..userid=".$userid;
 $user=$this->user_model->db_getuser($userid);
 $taskowner=$user[0]['Username'];
 return($taskowner);


}

public function js_add_root_task($id)
{


		$data['project_data']=$this->project_model->get_project($id);
		$data['user_data']=$this->user_model->get_user();

		

		// check the current user with the owner of the task

		//$data['vassignee']=strtolower($_GET['assignee']);
		$logged_inas = $_SESSION['username'];

		# Get parent task owner

		$data['vparent_task_id']=0;
		$taskid=$data['vparent_task_id'];
		$tskowner=$logged_inas;

	


		#echo "tasks.php BEFORE CHG DEF FORMAT DUE_DATE=".$data['vdue_date'];
		#$data['vgroup_id']=$_GET['groupid'];
		#$ddt=$this->task_model->chg_duedate_fmt($newdt);

		#$data['vddate']=$this->task_model->chg_duedate_def_datetype($data['vdue_date']);
		

		#$data['vddate2']=date('Y-m-d',strtotime($data['vdue_date']));
		#echo "tasks.php AFTER CHG DEF FORMAT DUE_DATE=".$data['vddate2'];

		$data['cdate']=$this->task_model->get_currdate();
		#echo "tasks.php today=".$data['cdate'][0]['today'];
		#$data['vparent_task_id']=$_GET['parent_task_id'];
 		#$data['vgroupid']=$_GET['groupid'];

 		$this->session->set_userdata($data);
#		$data['add_task_func']="true";

			
			$data['approved']=0;
			$data['status']=1;
				
		
		
		$this->session->set_userdata($data);
		$data['main_view']='tasks\js_insert_root_task';
		$this->load->view('layout\main.php',$data);


}

public function js_upd_tskdepon($id)
{
	$tskarr=json_decode($_GET['tsk_arr']);
	$tskstr=json_encode($tskarr);
	echo "tskstr=".$tskstr;
	print_r (explode(",",$tskstr));
	$newlst=str_replace(']','',str_replace('"',"",str_replace('["',"",$tskstr)));
	$stat=$this->task_model->upd_tskdepon($id,$newlst);
	echo "stat=".$stat;
	$this->session->set_flashdata('cleanup_deptask','<p class="bg-success">The depends_on_task has been cleaned up </p>');
				
				
	redirect('/projects');
}


public function js_add_task($id)
{


		# Get parent task owner

		$data['vparent_task_id']=$_GET['parent_task_id'];
		$taskid=$data['vparent_task_id'];

	
		$data['project_data']=$this->project_model->get_project($id);
		$data['user_data']=$this->user_model->get_user();
		$data['task_data']=$this->task_model->populate_dependson_tasks($id,$_SESSION['username'],$taskid);
		

		// check the current user with the owner of the task

		$data['vassignee']=strtolower($_GET['assignee']);
		$logged_inas = $_SESSION['username'];

		
		# if taskid != 0, get parent task's user id, otherwise assign the current login_user as the taskowner
		
		if ($taskid!=0)
			$tskowner=$this->get_task($taskid);
		else
			$tskowner=$logged_inas;

		$data['vdue_date']=$_GET['due_date'];


		#echo "tasks.php BEFORE CHG DEF FORMAT DUE_DATE=".$data['vdue_date'];
		$data['vgroup_id']=$_GET['groupid'];
		#$ddt=$this->task_model->chg_duedate_fmt($newdt);

		$data['vddate']=$this->task_model->chg_duedate_def_datetype($data['vdue_date']);
		

		$data['vddate2']=date('Y-m-d',strtotime($data['vdue_date']));
		#echo "tasks.php AFTER CHG DEF FORMAT DUE_DATE=".$data['vddate2'];

		$data['cdate']=$this->task_model->get_currdate();
		#echo "tasks.php today=".$data['cdate'][0]['today'];
		#$data['vparent_task_id']=$_GET['parent_task_id'];
 		$data['vgroupid']=$_GET['groupid'];

 		$this->session->set_userdata($data);
		$data['add_task_func']="true";

		if (strtolower($tskowner) != strtolower($logged_inas))
		{
			#echo "tskowner is different from logged_inas";
			# 1 for status means Pending Approval

			$data['approved']=1;
			$data['status']=NULL;
				
		}
		else
		{
			# when "task owner & logged in ownr are same";
			# 1 for status means Open

			$data['approved']=0;
			$data['status']=1;
		}

		
		$this->session->set_userdata($data);
		$data['main_view']='tasks\js_insert_task';
		$this->load->view('layout\main.php',$data);

}



public function validate_root_task() 
{
			
		$this->form_validation->set_rules('name','Task Name','trim|required|min_length[3]');
		$this->form_validation->set_rules('description','Task Description','trim|required|min_length[3]');
		$this->form_validation->set_rules('due_date','Due_Date','required|callback_due_date_validate');
		$this->form_validation->set_rules('parent_task_id','Parent Task Id','required');
		
		#$this->form_validation->set_rules('groupid','Group ID','required');

		$this->form_validation->set_rules('userid','User ID','required');


		
		if($this->form_validation->run() == FALSE)
		{
			#echo "form errors occurred";
			$taskerr = array(
			'taskerrors' => validation_errors());

			#echo $taskerr['taskerrors'];
			$this->session->set_flashdata($taskerr);

			if ($this->session->userdata('add_task_func')=="false")
			{
			
				$url="tasks/cre_task/".$this->session->userdata('project_data')->id;
			}
			else
			{
				$url="tasks/js_add_task/".$this->session->userdata('project_data')->id.'?assignee='.$this->session->userdata('vassignee').'&parent_task_id='.$this->session->userdata('vparent_task_id').'&groupid='.$this->session->userdata('vgroupid').'&due_date='.$this->session->userdata('vdue_date');
			
			}	
			   #redirect($url);

			$data['main_view']='tasks\js_insert_task';
			$this->load->view('layout\main.php',$data);
			return;
		}

		else

		{

			
			$convertDate=date('Y-m-d',strtotime($this->input->post('due_date')));
			#echo '<br>due_date='.$this->input->post('due_date');

			#echo '<br>converDate='.$convertDate;

			#echo "user_id=".$this->input->post('user_id');

			#echo "user logged in=".$this->session->userdata('user_id');
			#echo "tasks.php validate() status=".$this->input->post('status');

			$task = array(
				'project_id' =>$this->session->userdata('project_data')->id,
				'task_name' => $this->input->post('name'),
				'task_body' => $this->input->post('description'),
				'due_date' => $convertDate,
				'approved' =>$this->input->post('approved'),
				'status'=>$this->session->userdata('status'),
				'userid' =>$this->input->post('userid'),
				'parent_task_id' => $this->input->post('parent_task_id'),
				'groupid'=> $this->input->post('groupid')
			);
			
			$insert_id=$this->task_model->ins_task($task);



			if($insert_id)
			{
				echo "successfully inserted.Taskid=".$insert_id;
				$insert_id=$this->task_model->upd_root_task($insert_id);
				$this->session->set_flashdata('task_inserted','<p class="bg-success">The Task has been added </p>');
				?>
				<script>
				
				//window.close();

				</script>
				<?php
			}
			
			
			
			if(isset($add_task_func))
			{
				echo "add_Task";
			}
			else
			 {	
			 #	echo "tasks.php validate_func status=".$task['status'];
			 	redirect('/projects');
			 }
			#$this->output->set_output("done at php");

		}
}




public function validate_task() 
{
			
		$this->form_validation->set_rules('name','Task Name','trim|required|min_length[3]');
		$this->form_validation->set_rules('description','Task Description','trim|required|min_length[3]');
		$this->form_validation->set_rules('due_date','Due_Date','required|callback_due_date_validate');
		$this->form_validation->set_rules('parent_task_id','Parent Task Id','required');
		
		$this->form_validation->set_rules('groupid','Group ID','required');

		$this->form_validation->set_rules('userid','User ID','required');


		$t=$_POST['depends_on_task'];
		
		// for ($i=0;$i<sizeof($t);$i++)
		// {

		// 	echo "".$t[$i];

		// }
		// var_dump($_POST['depends_on_task']);
			#echo "task_name=".$t[0];
		$deptask=implode(",",$t);

		echo "depttask=".$deptask." deptask-size=".sizeof($t);
		$starr=$this->task_model->check_deptask_stat($this->session->userdata('project_data')->id,$t);
		echo "sizeof(starr)=".sizeof($starr);
		
		if (sizeof($starr)>0 || $this->session->userdata('approved')==1)
		{
			echo "there is atleast 1 or more unfinished dependent tasks..hence set the status to UNSCHEDULED";
			$vstatus=4;
		}
		else if (sizeof($starr)==0 || $this->session->userdata('approved')==1)

		{
			echo "No unfinished tasks...The task is to be set OPEN";
			$vstatus=1;
		}



		#echo "multi select task_name=".sizeof($_POST['task_name']) ;
		

		if($this->form_validation->run() == FALSE)
		{
			#echo "form errors occurred";
			$taskerr = array(
			'taskerrors' => validation_errors());

			#echo $taskerr['taskerrors'];
			$this->session->set_flashdata($taskerr);

			if ($this->session->userdata('add_task_func')=="false")
			{
			
				$url="tasks/cre_task/".$this->session->userdata('project_data')->id;
			}
			else
			{
				$url="tasks/js_add_task/".$this->session->userdata('project_data')->id.'?assignee='.$this->session->userdata('vassignee').'&parent_task_id='.$this->session->userdata('vparent_task_id').'&groupid='.$this->session->userdata('vgroupid').'&due_date='.$this->session->userdata('vdue_date');
			
			}	
			   #redirect($url);

			$data['main_view']='tasks\js_insert_task';
			$this->load->view('layout\main.php',$data);
			return;
		}

		else

		{

			
			$convertDate=date('Y-m-d',strtotime($this->input->post('due_date')));
			#echo '<br>due_date='.$this->input->post('due_date');

			#echo '<br>converDate='.$convertDate;

			#echo "user_id=".$this->input->post('user_id');

			#echo "user logged in=".$this->session->userdata('user_id');
			#echo "tasks.php validate() status=".$this->input->post('status');

			$task = array(
				'project_id' =>$this->session->userdata('project_data')->id,
				'task_name' => $this->input->post('name'),
				'task_body' => $this->input->post('description'),
				'due_date' => $convertDate,
				'approved' =>$this->input->post('approved'),
				'status'=>$vstatus,
				'userid' =>$this->input->post('userid'),
				'parent_task_id' => $this->input->post('parent_task_id'),
				'groupid'=> $this->input->post('groupid'),
				'depends_on_task'=> $deptask
			);
			
			$insert_id=$this->task_model->ins_task($task);



			if($insert_id)
			{
				echo "successfully inserted";
				$this->session->set_flashdata('task_inserted','<p class="bg-success">The Task has been added </p>');
				?>
				<script>
				
				//window.close();

				</script>
				<?php
			}
			
			
			
			if(isset($add_task_func))
			{
				echo "add_Task";
			}
			else
			 {	
			 #	echo "tasks.php validate_func status=".$task['status'];
			 	#redirect('/projects');
			 }
			#$this->output->set_output("done at php");

		}
}

public function js_approvetask($taskid)
{
	#echo "taskid to be approved=".$taskid;
	$exestat=$this->task_model->db_approve_task($taskid);
	echo $exestat;
}

public function due_date_validate($ddate)
{
	
	#echo "<br>due_Date_validate...parddt=".$this->session->userdata('parddt');
	#echo "ddate=".$ddate;

	$res=$this->task_model->check_duedate($ddate,$this->session->userdata('parddt'));
	$res2=$this->task_model->check_duedate_curdate($ddate);
	#echo "res=".$res;
	if ($res > 0 || $res2>0 )
	{
		$this->form_validation->set_message(__FUNCTION__, 'The duedate/to_be_completed_on can not be higher than the parent due date OR lower than the current date');
		return FALSE;
	}
	else
	{

		return TRUE;
	}

	

	
}

public function list_tasks($project_id) {
		$resultSet=Array();
		$username=$_SESSION['username'];
		$task = $this->task_model->get_list_tasks($project_id,$username);
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

public function del_task_old($id)
{

	$xs=$this->task_model->db_del_task($id);

	if($xs)
			{
				$this->session->set_flashdata('task_deleted','<p class="bg-success"> The Task has been deleted </p>');
			}

	redirect('projects/display/'.$this->session->userdata('project_data')->id);

	
}


public function js_del_task($id)
{

	$groupid=$_GET['groupid'];
	$xs=$this->task_model->del_task($id,$groupid);

	if($xs)
			{
				$this->session->set_flashdata('task_deleted','<p class="bg-success"> The Task has been deleted </p>');
			}

	redirect('projects/');

	
}




public function upd_task($id)
{

	$data['task']=$this->task_model->db_fetch_task($id);
	$data['user_data']=$this->user_model->get_user();
	#echo "$user_data['username']=".$user_data['username'];

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

public function js_upd_task($id)
{
	#echo "js_upd_Task id=".$id;
	
	$data['old_duedate']=$_GET['ddate'];
	$data['parddt']=$_GET['ptd'];
	$data['project_id']=$_GET['project_id'];
	#echo "<br>js_upd_task parddt=".$data['parddt']." old duedate=".$data['old_duedate'];
	
	

	$data['task']=$this->task_model->db_fetch_task($id);
	$data['user_data']=$this->user_model->get_user();

	# populate depends_on_tasks
	$data['task_data']=$this->task_model->populate_dependson_tasks($data['project_id'],$_SESSION['username'],$id);
	
	echo "task_data =".sizeof($data['task_data']);
	
	# Create $task array & assign what is captured in $data[task] above

	$task['task_id']=$data['task'][0]["id"];
	$task['task_name']=$data['task'][0]["task_name"];
	$task['group_id']=$data['task'][0]["groupid"];
	$task['due_date']=$data['task'][0]["due_date"];
	$task['approved']=$data['task'][0]["approved"];
	$task['status']=$data['task'][0]["status"];
	$task['depends_on_task']=$data['task'][0]["depends_on_task"];
	echo "existing depends_on_task=".$data['task'][0]["depends_on_task"];

	#$depends_on_task=$data['task_data'][0]["depends_on_task"];

	
	$vdepends_on_task=$data['task'][0]["depends_on_task"];

	if ($vdepends_on_task != NULL)
	{
		$task['depends_on_task']=explode(",",$vdepends_on_task);

		$deptskstr=$data['task'][0]["depends_on_task"];

		$starr=$this->task_model->check_deptask_stat($data['project_id'],$deptskstr);
		echo "sizeof(starr)=".sizeof($starr);
	
		if (sizeof($starr)>0 || $this->session->userdata('approved')==1)
		{
			echo "there is atleast 1 or more unfinished dependent tasks..hence set the status to UNSCHEDULED";
			$task['status']=4;
		}
		else if (sizeof($starr)==0 || $this->session->userdata('approved')==1)
		{
			echo "No unfinished tasks...The task is to be set OPEN";
			$task['status']=1;
		}
	}
	else if ($this->session->userdata('approved')==1)
	{
			$task['status']=1;
	}

	echo "status after if loop....".$task['status'];


	#echo "$task[depends_on_task][0]=".$task['depends_on_task'][0];
	$task['latest_update']=$data['task'][0]["latest_update"];
	
	if ($task['status']==3)
	{
		$task['clo_comments']=$data['task'][0]["clo_comments"];
	#	$this->task_model->get_dot_values($task['task_id']);
	}




	
	#echo "task closing comments".$data['task'][0]["clo_comments"];
	#echo "<br>taskid=".$task['task_id'];
	#echo "<br>js_upd_task grpid=".$task['group_id'];


	#$data['vddate']=$this->task_model->chg_duedate_fmt_forupd($this->session->userdata('parddt'));
	
	$data['vddate']=date('d-M-Y',strtotime($data['parddt']));

	# "defvddate" below is to set default date for due_date in the form.This specific format reqd, otherwise it does NOT work.

	$task['defvddate']=date('Y-m-d',strtotime($task['due_date']));
	
	#echo "<br>parddt=".$data['parddt'];
	#echo "<br>vddate is set to".$data['vddate'];
	#echo "<br>defvddate is set to".$task['defvddate'];
		
	$data['today']=date('d-M-Y');
	#echo "tasks.php today=".$data['today'];

	$this->session->set_userdata($data);

	#	echo "<br><br>tasks.php AFTER CHG DEF FORMAT DUE_DATE=".$this->session->userdata['vddate'];



	# set session data when you have variable name other than 'data' as below

	$this->session->set_userdata('task',$task);

	echo "<br>ID to be passed to validate task=".$this->session->userdata['task']['task_id'];

	#echo "js_upd_task....Group_id=".$this->session->userdata['task']['group_id'];
	#echo "js_upd_task....task_name=".$this->session->userdata['task']['task_name'];
	#echo "js_upd_task....due_Date=".$this->session->userdata['task']['due_date'];
	#echo "<br>parddt=".$this->session->userdata('parddt');
	#echo "<br>olddt=".$this->session->userdata('old_duedate');
	
	# accessing the variable named other than data

	
			


		
	$data['main_view']='tasks\upd_view';
	$this->load->view('layout\main.php',$data);



	
	#redirect('projects/display/'.$this->session->userdata('project_data')->id);

	
}




public function validate_upd_task()
{


		echo "validate_upd_task fired...";


		$vdue_date=date('Y-m-d',strtotime($this->input->post("due_date")));
	#	echo "<br>vdue_Date=".$vdue_date;
		
		$this->form_validation->set_rules('task_name','Task Name','trim|required|min_length[3]');
		$this->form_validation->set_rules('description','Task Desscription','trim|required|min_length[3]');
		$this->form_validation->set_rules('due_date','Due Date','required|callback_due_date_validate[$vdue_date]');

		

		echo 'from validate_upd_task task_id 2bpassed to validate_status='.$this->session->userdata["task"]["task_id"];


		if ($this->input->post('status')==3)
		{
			$tid=$this->session->userdata['task']['task_id'];
			#set_value('task_id', $tid); 
			echo "validate status check for childtasks for id=".$tid;
			$this->form_validation->set_rules('task_id','task_id','callback_id_validate');

		}



		if($this->form_validation->run() == FALSE)
		{
			$valerr = array(
			'errors' => validation_errors());

			#echo "validate_error_func ID=".$this->session->userdata['task']['task_id'];


			#echo "valerr=".$valerr['errors'];

			$this->session->set_flashdata($valerr);

			#http://localhost/ci/tasks/js_upd_task/"+taskid+'?project_id='+project_id+'&ddate='+vduedate+'&ptd='+pt_ddate,'_self'


			#redirect('tasks/js_upd_task/'.$this->session->userdata['task']['task_id'].'?project_id='.$this->session->userdata['project_id'].'&ptd='.$this->session->userdata('parddt').'&ddate='.$this->session->userdata['vddate']);

		}
		else
		{
			#$id=$this->session->userdata('task_id');
			$id=$this->session->userdata['task']['task_id'];
			#$grpid=$this->session->userdata('group_id');
			$grpid=$this->session->userdata['task']['group_id'];

			
			#echo "id to be passed on for chldtasks=".$id."grpid=".$grpid;
			$olddt=$this->session->userdata('old_duedate');
			$newdt=$vdue_date;
			#echo "validate_upd_task....olddt=".$olddt;

			#$ddt=$this->task_model->chg_duedate_fmt($newdt);
			#echo "change_dt_fmt ddt=".$ddt[0]['ddate'];
			#$data['task'][0]["task_name"];


			if ($this->input->post('status')!==3)
			{
				$clo_comments=NULL;
				$clo_date=date('Y-m-d',strtotime('0000-00-00'));
			}
			else if ($this->input->post('status')==3)
			{
				$clo_comments=$this->input->post('clo_comments');
				$clo_date=date('Y-m-d');
			#	echo "clo_date=".$clo_date;
			}

			
			echo "latest_upate=".$this->session->userdata['task']['latest_update'];

			if ($this->input->post('depends_on_task') != NULL)
				$dep_tsk=implode(",",$this->input->post('depends_on_task'));			
			else
				$dep_tsk=NULL;

			# Update "latest_upd_datetime" only if the latest_update field is updated (with different value than the previous value)

			if ($this->input->post('latest_update') !== $this->session->userdata['task']['latest_update'])
			{
				echo "The latest update has been edited";
				$v_latestupd_datetime=date('Y-m-d H:i');

				$task = array(
				'id'=> $this->session->userdata['task']['task_id'],
				'task_name' => $this->input->post('task_name'),
				'task_body' => $this->input->post('description'),
				'due_date' => $vdue_date,
				'userid' => $this->input->post('userid'),
				'status'=>$this->input->post('status'),
				'approved' =>$this->session->userdata['task']['approved'],
				'clo_comments'=>$clo_comments,
				'clo_date'=>$clo_date,
				'depends_on_task'=>$dep_tsk,
				'latest_update'=>$this->input->post('latest_update'),
				'latestupd_datetime'=>$v_latestupd_datetime);
			}
			else
			{
				$task = array(
				'id'=> $this->session->userdata['task']['task_id'],
				'task_name' => $this->input->post('task_name'),
				'task_body' => $this->input->post('description'),
				'due_date' => $vdue_date,
				'userid' => $this->input->post('userid'),
				'status'=>$this->input->post('status'),
				'approved' =>$this->session->userdata['task']['approved'],
				'depends_on_task'=>$dep_tsk,
				'clo_comments'=>$clo_comments,
				'clo_date'=>$clo_date);
			}

			
			#echo "status=".$this->input->post('status');

			$xs=$this->task_model->db_upd_task($task);

			
			if($xs)
			{

				if ($this->input->post('status')==3)
				{
					echo "status=".$this->input->post('status');
					echo "</b>The task is updated & firing get_dot_values() to update other tasks";
					$stat=$this->task_model->get_dot_values($task['id']);
					if ($stat=="TRUE")
					{
						echo "DEPENDENT TASKS UPDATED SUCCESSFULLY";
						$this->session->set_flashdata('deptsks_updated','<p class="bg-success"> The task & its dependent task(s) has been updated </p>');

					}

				}

				$this->session->set_flashdata('task_updated','<p class="bg-success"> The Task has been updated </p>');
			}

			
			$chldtasks=$this->task_model->get_tasks($id,$grpid,$olddt,$newdt);

			if (sizeof($chldtasks) > 0)
			{
				$this->task_model->db_upd_ddateofsubtasks($chldtasks,$newdt);
			

				#foreach ($chldtasks as $tasks)
				#{
				#	echo " ".$tasks["id"];

				#}	
			}
			else
			{
				$this->session->set_flashdata('subtask_not_updated','<p class="bg-warning"> No child tasks are there or none found meeting the given conditions</p>');
			}

			
			redirect('projects');

		}
}

public function id_validate($taskid) {

$taskid=$this->session->userdata['task']['task_id'];
echo "Firing taskid_validate for task=".$taskid;
$rwcnt=$this->task_model->chk_opn_chldtsk($taskid);
echo "</br> rowcnt=".$rwcnt;

if ($rwcnt>0)
{
	echo "</br>Children tasks found....The operation failed..";
	$this->form_validation->set_message(__FUNCTION__, '<b><div style="color:red">The Task can not be closed, as there is still one or more "incomplete" child/sub tasks</div>');
		
	return FALSE;
}
else
	return TRUE;


}

public function view_tasks($id)
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
