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
		#echo "cdate=".$data['cdate'];
		echo "add_root_task today=".$data['cdate'][0]['today'];
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
		
		$data['main_task']=$this->task_model->db_fetch_task($taskid);

		echo "main_task[tdd]=".$data['main_task'][0]['tentative_due_date'];


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
			# 1 for status means Pending Approval;approved=1 (for "NO")

			$data['approved']=1;
			$data['status']=NULL;
				
		}
		else
		{
			# when "task owner & logged in ownr are same";
			# 1 for status means Open; approved=0 (for YES)

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
		#$this->form_validation->set_rules('due_date','Due_Date','required|callback_due_date_validate');
		$this->form_validation->set_rules('parent_task_id','Parent Task Id','required');

		$tsd=$this->input->post('tentative_start_date');
		$ted=$this->input->post('tentative_due_date');

		if ($tsd=="")
			$tsd=NULL;
		
		if ($ted=="")
			$ted=NULL;
			

		if ($tsd !== NULL && $ted !== NULL )
		{
			echo "TSD & TED is not NULL ";

		
			$this->form_validation->set_rules('tentative_start_date','tentative_start_date','required|callback_tentative_start_date_validate');
	
			$this->form_validation->set_rules('tentative_due_date','tentative_due_date','required|callback_tentative_due_date_roottask');

		}
		else
		{
			$this->form_validation->set_rules('tentative_due_date','tentative_due_date','required|callback_tentative_tsd_ted_notnull');
		}
				


		$this->form_validation->set_rules('userid','User ID','required');


		echo "validate_root status=".$this->input->post('status');
		
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

				$url="tasks/js_add_root_task/".$this->session->userdata('project_data')->id.'&parent_task_id='.$this->session->userdata('vparent_task_id');
				
				//$url="tasks/js_add_task/".$this->session->userdata('project_data')->id.'?assignee='.$this->session->userdata('vassignee').'&parent_task_id='.$this->session->userdata('vparent_task_id').'&groupid='.$this->session->userdata('vgroupid').'&due_date='.$this->session->userdata('vdue_date');
			
			}	
			   //redirect($url);

			$data['main_view']='tasks\js_insert_root_task';
			$this->load->view('layout\main.php',$data);
			return;
		}

		else

		{
			echo "js_add_root_task validate due_date=".$this->input->post('due_date');
			if ($this->input->post('due_date')!=NULL)
				$convertDate=date('Y-m-d',strtotime($this->input->post('due_date')));
			else
				$convertDate=$this->input->post('tentative_due_date');

			echo "js_add_root_task validate convertDate=".$convertDate;
			
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
				'groupid'=> $this->input->post('groupid'),
				'tentative_start_date' => $this->input->post('tentative_start_date'),
				'tentative_due_date' => $this->input->post('tentative_due_date')
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
			 	redirect('/projects');
			 }
			

		}
}




public function validate_task() 
{
			
		$this->form_validation->set_rules('name','Task Name','trim|required|min_length[3]');
		$this->form_validation->set_rules('description','Task Description','trim|required|min_length[3]');
		#$this->form_validation->set_rules('due_date','Due_Date','required|callback_due_date_validate');
		$this->form_validation->set_rules('parent_task_id','Parent Task Id','required');
		
		$this->form_validation->set_rules('groupid','Group ID','required');

		$this->form_validation->set_rules('userid','User ID','required');

		$this->form_validation->set_rules('tentative_start_date','tentative_start_date','required');

		$tsd=$_POST['tentative_start_date'];

		$this->form_validation->set_rules('tentative_due_date','tentative_due_date','callback_tentative_due_date_validate[$tsd]');


		// for ($i=0;$i<sizeof($t);$i++)
		// {

		// 	echo "".$t[$i];

		// }
		// var_dump($_POST['depends_on_task']);
			#echo "task_name=".$t[0];
		
		$deptask=NULL;

		if (isset($_POST['depends_on_task']))
		{
			$t=$_POST['depends_on_task'];

			$deptask=implode(",",$t);

			echo "depttask=".$deptask." deptask-size=".sizeof($t);
			$starr=$this->task_model->check_deptask_stat($this->session->userdata('project_data')->id,$t);
			echo "sizeof(starr)=".sizeof($starr);

			####
			# approved=0(yes);aproved=1(no)
			###########

			if (sizeof($starr)>0 || $this->session->userdata('approved')==0)
			{
				echo "there is atleast 1 or more unfinished dependent tasks..hence set the status to UNSCHEDULED";
				$vstatus=4;
			}
			else if (sizeof($starr)==0 || $this->session->userdata('approved')==0)
			{
				echo "No unfinished tasks...The task is to be set OPEN";
				$vstatus=1;
			}


		}
		else if ($this->session->userdata('approved')==0)
		{
			echo "Approved=".$this->session->userdata('approved');
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

			$convertDate=$this->session->userdata['main_task'][0]['tentative_due_date'];

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
				'depends_on_task'=> $deptask,
				'tentative_start_date' =>$this->input->post('tentative_start_date'),
				'tentative_due_date' =>$this->input->post('tentative_due_date')
				

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
			 	redirect('/projects');
			 }
			
		}
}


public function tentative_start_date_validate($tsd)
{
	//echo "<br>callback TSD fired...cdate=".date('Y-m-d',strtotime($this->session->userdata['cdate'][0]['today']))." tsd=".$tsd;

	$today=date('Y-m-d',time());


	echo "callback ted.....today=".$today.' tsd='.$tsd;

	if ($tsd < $today)
	{
		echo "<br>tentative date is lower than the current date";
		$this->form_validation->set_message(__FUNCTION__, '</div><div class="col-xs-9 setmsg" > The Tenttive Start Date can not be lower than current date !!</div><div class="col-xs-6">');
	
		return FALSE;

	}
	else
		return true;

}



public function tentative_due_date_validate($ted)
{

echo "firing callback_ted_validate";
echo "ted=".$ted."TSD=".$_POST['tentative_start_date'];

if ($_POST['tentative_start_date'] > $ted)
{
	$this->form_validation->set_message(__FUNCTION__, '</div><div class="col-xs-12 setmsg">The tentative end date is lower than tentative start date </div><div class="col-xs-6">');
	
	return FALSE;


}
else
 return true;

}


public function tentative_tsd_ted_notnull($ted)
{

echo "firing callback_ted_tsd_notnull_validate";
echo "ted=".$ted."TSD=".$_POST['tentative_start_date'];

if ($_POST['tentative_start_date'] == NULL || $_POST['tentative_due_date'] == NULL )
{
	$this->form_validation->set_message(__FUNCTION__, '</div><div class="col-xs-8 setmsg">Tentative Start Date/Tentative End Date Can NOT be NULL</div><div class="col-xs-6">');
	
	return FALSE;


}
else
 return true;

}



public function tentative_due_date_roottask($ted)
{

echo "firing callback_ted_validate";
echo "ted=".$ted."TSD=".$_POST['tentative_start_date'];

if ($_POST['tentative_start_date'] > $ted)
{
	$this->form_validation->set_message(__FUNCTION__, '</div><div class="col-xs-9 setmsg">The tentative end date is lower than tentative start date </div><div class="col-xs-6">');
	
	return FALSE;


}
else
 return true;

}




public function js_approvetask($taskid)
{
	#echo "taskid to be approved=".$taskid;
	$exestat=$this->task_model->db_approve_task($taskid);
	echo $exestat;
}

public function due_date_validate($ddate)
{

	echo "callback_due_Date_validate firing..."	;
	#echo "<br>due_Date_validate...parddt=".$this->session->userdata('parddt');
	#echo "ddate=".$ddate;

	$res=$this->task_model->check_duedate($ddate,$this->session->userdata('parddt'));
	
	$today=date('Y-m-d',time());
	
	$res2=0;
	if ( $ddate < $today )
	{
		$res2=1;
	}
	
	

	#$res2=$this->task_model->check_duedate_curdate($ddate);

	$res3=$this->task_model->check_duedate_gt_ted($ddate,$this->input->post('tentative_due_date'));

	echo ">currdate check num_rows=".$res2;
	echo "</br>res3=".$res3;
	echo "ted is lower....date from POST var=".$this->input->post('tentative_due_date')." ddate=".$ddate;

	echo "</br>res=".$res."res2=".$res2."res3=".$res3;

	#echo "res=".$res;
	if ($res > 0 || $res2>0 || $res3 > 0 )
	{
		$this->form_validation->set_message(__FUNCTION__, '</div><div class="col-xs-9 setmsg">Due date/to_be_completed_on can not be higher than Parent Task"s Due_Date/Tentative_Due_Date OR Lower than Current Date !!</div> <div class="col-xs-6">');
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

	#####
	# populate depends_on_tasks
	#################

	$data['task_data']=$this->task_model->populate_dependson_tasks($data['project_id'],$_SESSION['username'],$id);
	
	echo "task_data =".sizeof($data['task_data']);
	
	################
	# Create task array & assign what is captured in $data[task]
	###############################

	$task['task_id']=$data['task'][0]["id"];
	$task['task_name']=$data['task'][0]["task_name"];
	$task['task_body']=$data['task'][0]["task_body"];
	$task['group_id']=$data['task'][0]["groupid"];
	$task['due_date']=$data['task'][0]["due_date"];
	$task['approved']=$data['task'][0]["approved"];
	$task['status']=$data['task'][0]["status"];
	$task['parent_task_id']=$data['task'][0]["parent_task_id"];
	$task['depends_on_task']=$data['task'][0]["depends_on_task"];
	$task['clo_comments']=$data['task'][0]["clo_comments"];
	$task['started_date']=$data['task'][0]["started_date"];
	$task['tentative_start_date']=$data['task'][0]["tentative_start_date"];
	$task['tentative_due_date']=$data['task'][0]["tentative_due_date"];

	
	echo "existing depends_on_task=".$data['task'][0]["depends_on_task"];

	#echo "status as fetched from db=".$task['status'];
	#$depends_on_task=$data['task_data'][0]["depends_on_task"];

	echo "parent Task id=".$task['parent_task_id'];
	
	$vdepends_on_task=$data['task'][0]["depends_on_task"];

	###############
	# if started_date is null, assign current date to it.
	################################

	if ($task['started_date']==NULL)
	{
		$task['started_date']=date('Y-m-d\TH:i:s');
		echo "assigned current date to started_Date=".$task['started_date'];
	}


	######
	# If there are any unfinished dependent tasks, set
	# status to 4 (unscheduled)
	################


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
		#else if (sizeof($starr)==0 || $this->session->userdata('approved')==1) && $task['status']==4
		#{
		#	echo "No unfinished tasks...The task is to be set OPEN";
		#	$task['status']=1;
		#}
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

	

	
	
	$data['vddate']=date('d-M-Y',strtotime($data['parddt']));

	########
	# "defvddate" below is to set default date for due_date in the #form.This specific format reqd, otherwise it does NOT work.
	####################
	

	if ($task['due_date'] != NULL)
	{
		echo "due_date=".$task['due_date']."defvddate=".date('Y-m-d',strtotime($task['due_date']));

		$task['defvddate']=date('Y-m-d',strtotime($task['due_date']));
	}
	else
		$task['defvddate']=$task['tentative_due_date'];
	
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


	echo "<br>Parent_task_id to be passed=".$this->session->userdata['task']['parent_task_id'];

	#echo "js_upd_task....Group_id=".$this->session->userdata['task']['group_id'];
	#echo "js_upd_task....task_name=".$this->session->userdata['task']['task_name'];
	#echo "js_upd_task....due_Date=".$this->session->userdata['task']['due_date'];
	#echo "<br>parddt=".$this->session->userdata('parddt');
	#echo "<br>olddt=".$this->session->userdata('old_duedate');
	
	# accessing the variable named other than data

	
			


		
	$data['main_view']='tasks\upd_view';
	$this->load->view('layout\main.php',$data);



	
	
	
}




public function validate_upd_task()
{


		$vdue_date=date('Y-m-d',strtotime($this->input->post("due_date")));
	#	echo "<br>vdue_Date=".$vdue_date;
		
		$this->form_validation->set_rules('task_name','Task Name','trim|required|min_length[3]');
		$this->form_validation->set_rules('description','Task Desscription','trim|required|min_length[3]');


		$this->form_validation->set_rules('tentative_start_date','tentative_start_date','required|callback_tentative_start_date_validate');
		
		$this->form_validation->set_rules('tentative_due_date','tentative_due_date','required');

		$stat=$this->input->post("status");

		
		########
		# if stat is "in progress", trigger callback function
		##########################

		if ($stat==2)
		{
			echo "</br>status=".$stat;

			$this->form_validation->set_rules('due_date','Due Date','required|callback_due_date_validate[$vdue_date]');	

		}

		$vstd=date('Y-m-d\TH:i:s',strtotime($this->input->post('started_date')));


		if ($this->input->post('status')==1 || $this->input->post('status')==4)
		{
			echo "status is in open or unschedued..setting started_Date to NULL";
				$vstd=NULL;
		}
		

		##########
		# if status is completed, check for open childtasks
		#####################

		if ($this->input->post('status')==3)
		{
			$tid=$this->session->userdata['task']['task_id'];
			#set_value('task_id', $tid); 
			echo "</br>validate status check for childtasks for id=".$tid;
			$this->form_validation->set_rules('id','id','callback_task_id_validate');

			
		}

		########
		# if the parent task is already completed, nothing else is   # possible to perform other than setting the current task to  # "completed"
		###############

		if ($this->input->post('status')!==3)
		{

			$this->form_validation->set_rules('task_id','task_id','callback_ptstat_check');
		}
	

		if($this->form_validation->run() == FALSE)
		{
			$valerr = array(
			'errors' => validation_errors());

		
			$this->session->set_flashdata($valerr);
		
		
			$data['main_view']='tasks\upd_view';
			$this->load->view('layout\main.php',$data);
			#return;

			#echo "<br>redirect to the url";
		#redirect('tasks/js_upd_task/'.$this->session->userdata['task']['task_id'].'?project_id='.$this->session->userdata['project_id'].'&ptd='.$this->session->userdata('parddt').'&ddate='.$this->session->userdata['vddate'],$data);

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

			############
			# post only closing comments, if status is "completed"
			#########

			if ($this->input->post('status')!==3)
			{
				$clo_comments=NULL;
				$clo_date=date('Y-m-d',strtotime('0000-00-00'));
			}
			else if ($this->input->post('status')==3)
			{
				$clo_comments=$this->input->post('clo_comments');
				$clo_date=date('Y-m-d');
			}

			
			echo "latest_upate=".$this->session->userdata['task']['latest_update'];

			if ($this->input->post('depends_on_task') != NULL)
				$dep_tsk=implode(",",$this->input->post('depends_on_task'));			
			else
				$dep_tsk=NULL;

			###########
			# Update "latest_upd_datetime" only if the latest_update # field is updated (with different value than existing    # value)
			#################################


			if ($this->input->post('latest_update')=="")
				$latupd=NULL;

			if  ($latupd != NULL && $this->input->post('latest_update') !== $this->session->userdata['task']['latest_update'])
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
				'latestupd_datetime'=>$v_latestupd_datetime,
				'started_date'=>$vstd,
				'tentative_start_date'=>$this->input->post('tentative_start_date'),
				'tentative_due_date'=>$this->input->post('tentative_due_date')
				
			);
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
				'clo_date'=>$clo_date,
				'started_date'=>$vstd,
				'tentative_start_date'=>$this->input->post('tentative_start_date'),
				'tentative_due_date'=>$this->input->post('tentative_due_date')
				
			);
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


					####
					# If this is the last task to be closed          # under  a parent, the parent task status         # should be set to "completed"
					##############

					$pt_taskid=$this->session->userdata['task']['parent_task_id'];

					$pt_rwcnt=$this->task_model->chk_opn_chldtsk($pt_taskid);

					echo "pt_taskid=".$pt_taskid.' pt_rwcnt='.$pt_rwcnt;


					if ($pt_rwcnt==0)
					{
						echo "the parent task is to be closed...";
						$tskid=$this->task_model->set_tskstat_completed($pt_taskid);

						####
						# Change the status of dependent on tasks,   # (dot) pointing this task, if  any, to open
						##########

						$stat=$this->task_model->get_dot_values($pt_taskid);
					
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

			
			#redirect('projects');

		}
}


public function ptstat_check($taskid) {

#$this->session->userdata['task']['task_id'];

echo "</br>firing callback_ptstat_check()";

echo "parent_Task_id=".$this->session->userdata['task']['parent_task_id'];
$ptsk=$this->session->userdata['task']['parent_task_id'];
$nrw=$this->task_model->get_parent_status($ptsk);

echo "ptstat_check num of rows=".$nrw;

if ($nrw>0)
{
	echo "</br>Could NOT change the task's status,as the master task is already closed !";
	$this->form_validation->set_message(__FUNCTION__, '</div><div class="col-xs-9 setmsg">Could NOT change the task status,as the master task is already closed !!</div><div class="col-xs-6">');
	#$this->session->set_flashdata('master_closed','<p style="color:red;"> Could not update status, as its master task is completed </p>');

	
	return FALSE;
}
else
	return TRUE;

}


public function task_id_validate($taskid) {

echo "</br>Firing taskid_validate for task=".$taskid;
$taskid=$this->session->userdata['task']['task_id'];
$pt_taskid=$this->session->userdata['task']['parent_task_id'];

echo "pt_taskid=".$pt_taskid;

$rwcnt=$this->task_model->chk_opn_chldtsk($taskid);
$pt_rwcnt=$this->task_model->chk_opn_chldtsk($pt_taskid);

echo "</br> rowcnt=".$rwcnt;

if ($rwcnt>0)
{
	echo "</br>Children tasks found....The operation failed..";
	$this->form_validation->set_message(__FUNCTION__, '</div><div class="col-xs-9 setmsg">The Task Can NOT be closed, as Incomplete Child Task(s) still exists !!</div>');
		
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
