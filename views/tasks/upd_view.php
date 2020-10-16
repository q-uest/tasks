<!DOCTYPE html>
<html>
<head>
	<title>CI Test</title>


<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type = 'text/javascript' src = "<?php echo base_url(); 
         ?>js/add_new_tasks.js"></script> 



<style>
	body{
	background-color: #5F6363;
	color: white;
		}


	#.fldcss {
		background-color: grey;
		color: white;
		font-weight:bold;
		font-size: 20px;
		}
	}
</style>

</head>

<body>

<div class="container">




<?php 
//echo "<h3>Tasks for <b>".$this->session->userdata('project_data')->project_name."</b></h3>"; 
?>


<?php if($this->session->flashdata('errors')): ?>
		<?php echo $this->session->flashdata('errors') ?>

<?php endif; ?>

<?php $attributes = array('id'=>'task_form','class'=> 'form_horizontal'); ?>



<?php echo form_open('tasks/validate_upd_task',$attributes); ?>



<div class="col-xs-6" style="border-right:1px red solid;">

<div class="col-xs-12">

<?php 

#echo form_label('Task_id'); 

$data = array('class' => 'form-control',
			  'name' => 'task_id',
			  'value'=> $this->session->userdata['task']["task_id"]        
			);
?>

<?php echo form_hidden($data,$this->session->userdata['task']["task_id"]);  ?>

</div>


<div class="col-xs-12" id="sdtdiv" style="display:none;">

<?php 

#echo form_label('Task_id'); 

$data = array('class' => 'form-control',
			  'name' => 'started_date',
			  'id' => 'started_date',
			  'value'=> $this->session->userdata['task']["started_date"]        
			);
?>

<?php echo form_input($data,$this->session->userdata['task']["started_date"]);  ?>

</div>




<div class="col-xs-12" >

<?php 

echo form_label('Task'); 

if (isset($_POST["task_name"]))
{
	
	$vname=$_POST["task_name"];
}
else
{	
	
	$vname=$this->session->userdata['task']['task_name'];
}



$data = array('class' => 'form-control',
			  'name' => 'task_name',
			  'placeholder' => $vname
			  			 );
?>

<?php echo form_input($data,$vname);  ?>



</div>

<div class="col-xs-12" style="margin-top:20px">

<?php echo form_label('Description'); ?>

<?php 

#echo "post=".$_POST;

if (isset($_POST['description']))
{
	$vbody=$_POST["description"];
}
else
{	
	
	$vbody=$this->session->userdata['task']['task_body'];
	
}


$data = array('class' => 'form-control',
			  'name' => 'description',
			  'placeholder' => 'Task Description',
			'rows'=>3);
?>


<?php echo form_textarea($data,$vbody);  ?>



</div>

<div class='col-xs-12' style="margin-top:20px">

<?php 



if ($this->session->userdata('approved')==0)
{

	echo form_label('Assigned to'); 

	$data=array('class' => 'form-control',
			  'name' => 'userid',
			  'placeholder' => 'Choose userid');

	$options=array();

	foreach($this->session->userdata('user_data') as $user)
	{
		
		$options[$user['id']]=$user['username'];
	}

	echo form_dropdown('userid', $options,$this->session->userdata('user_id'), 'class="form-control"'); 	
}
else
{
	echo form_hidden('userid',$this->session->userdata('user_id')); 		
}

?>
</div>


<div class="col-xs-12" id='statdiv' style="margin-top:20px">

<?php

	echo form_label('Dependent on Tasks'); 	

	$data=array('class' => 'form-group',
			  'name' => 'depends_on_task[]'			  
				);

	$selected=array();
	

	foreach ($this->session->userdata('task_data') as $task)
	{
	
		#echo "<option value=".$options[$task['id']].">".$task['task_name']."</option>";
	
		$selected[$task['id']]=$task['task_name'];
		
	}

	#echo form_input($task,'class="form-control"'); 	
	#echo form_multiselect('depends_on_task[]', $selected, set_value('depends_on_task'),"class='css-style col-xs-12'");

	#echo set_select('depends_on_task[]',$this->session->userdata('depends_on_task'));

#$this->session->userdata['task']["status"]


	if ($this->session->userdata['task']["depends_on_task"] != NULL)
	{

		#echo "default selected=".$this->session->userdata['task']["depends_on_task"][0];
		echo form_multiselect('depends_on_task[]', $selected, $this->session->userdata['task']["depends_on_task"],"class='css-style col-xs-12' style='margin-bottom:20px;'");
	}
	else
	{
		echo form_multiselect('depends_on_task[]', $selected, NULL,"class='css-style col-xs-12' style='margin-bottom:20px;'");	
	}
?>

</div>

</div>



<div class="col-xs-4">

<div class="col-xs-12 form-group" id='statdiv'>
<?php 

echo form_label('Status');


if (isset($_POST["status"]))
{
	
	$vstat=$_POST["status"];
}
else
{	
	
	$vstat=$this->session->userdata['task']["status"];
}




#echo "Task's status=".$this->session->userdata['task']["status"];
if ($vstat != 4 )
{
 
$data = array('class' => 'form-control',
				'id' => 'status',
			  'name' => 'status',
			  'value' => $vstat);

 	$stoptions=array(1=>'Open',2 =>'In Progress',3 => 'Completed',4 => 'Unscheduled');
	echo form_dropdown('status', $stoptions,$vstat,'onChange="check_for_compl();" id="status" class="form-control"'); 	

 } 
 else 
 {

 	$data = array('class' => 'form-control',
				'id' => 'status',
			  'name' => 'status',
			'value' => $vstat);

 	$stoptions=array(4=>'Unscheduled');
 	echo form_dropdown('status',$stoptions,$vstat,'id="status" class="form-control"');

 }

?>

</div>
<script type="text/javascript">

function check_for_compl() {
	cmtdiv=document.getElementById("cmtdiv");
	cmtcol=document.getElementById('clo_comments');
	ddatedivi=document.getElementById('ddatediv');
	dditm=document.getElementById("status");
	sdtitm=document.getElementById("started_date");

	if (dditm.value==3)
	{
		console.log("Completed has been choosen");
		
			cmtdiv.style="display:block";
			cmtcol.style="display:block";
	}
	else
	{
			console.log("other than completed has been choosen"+dditm.value);
			cmtdiv.style="display:none";
			cmtcol.style="display:none";
	}

	console.log("ddate.value="+dditm.value);


	
	if (dditm.value==2 || dditm.value==3 )
	{
		console.log("dditm=completed or in progress!!started_Date="+sdtitm.value);
		ddatedivi.style="margin-top:20px;display:block";

		// if started_date is null or empty, assign the value captured

		if (sdtitm.value == null||sdtitm.value=="")
		{
			console.log("sdtitm is null currently");
			sdtitm.value=sdtitm_val;
		}
		
	}
	else
	{
		sdtitm_val=sdtitm.value;
		sdtitm.value=null;
		console.log("dditm=open or Unscheduled");
		ddatedivi.style="display:none";
	}
	
}


</script>





<?php if ($this->session->userdata['task']["status"]==3)
{
?>


<div class="col-xs-12 form-group" id="cmtdiv" style="display:block">
<?php }

else
{
?>

<div class="col-xs-12 form-group" id="cmtdiv" style="display:none">

<?php
}
?>

<?php

$data = array('class' => 'form-control',
			  'name' => 'clo_comments',
			  'id'=>'clo_comments',
			  'placeholder' => 'Closing Comments',
				'rows'=>2,
				'style' =>"background-color: blue;color:white;"
			);
?>

<?php echo form_textarea($data,$this->session->userdata['task']["clo_comments"]);  ?>

</div>




<?php 

########
# Tentative Start date
#########################

echo "<div class='col-xs-12' style='margin-top:10px'>";
echo form_label('Tentative Start Date'); 
 
if (isset($_POST["tentative_start_date"]))
	$tsd=$_POST["tentative_start_date"];
else
	$tsd=$this->session->userdata['task']['tentative_start_date'];


#echo "TSD=".$this->session->userdata['task']['tentative_start_date'];

$data = array('class' => 'form-control',
			  'name' => 'tentative_start_date',
			  'type'=>'date',
			  'value'=> $tsd
			 );


echo form_input($data,"",'style=margin-bottom:5px;');  

#echo form_label("between ".$this->session->userdata['cdate'][0]['today'].' & '.$this->session->userdata['vddate'][0]['ddate']);

echo "</div>";

######
# Tentative Due date
##########################

echo "<div class='col-xs-12' style='margin-top:20px;'>";

echo form_label('Tentative Due Date',''); 


if (isset($_POST["tentative_due_date"]))
	$ted=$_POST["tentative_due_date"];
else
	$ted=$this->session->userdata['task']['tentative_due_date'];

 

$data = array('class' => 'form-control',
			  'name' => 'tentative_due_date',
			  'type'=>'date',
			  'value'=>$ted
			  );




echo form_input($data);  

#echo form_label('between '.$this->session->userdata['vddate'][0]['ddate'].' &'.' Tentative Start Date');

echo "</div>";

?>

<div class="col-xs-12" style="margin-top: 5px;">

<?php echo form_label('(Must be >='.$this->session->userdata['today'].' < Tentative Start Date)'); ?>

</div>


<?php 


if (isset($_POST["tentative_due_date"]))
	$ddlbl=$_POST["tentative_due_date"];
else
	$ddlbl=$this->session->userdata['task']['tentative_due_date'];


if (isset($_POST["status"]))
{
	
	$vshowdd=$_POST["status"];
}
else
{	
	$vshowdd=$this->session->userdata['task']["status"];
}





echo "<div class='col-xs-12 ddatediv' id='ddatediv' style='margin-top:20px;'>";

echo form_label('Due Date',''); 


$val=$this->session->userdata['task']['defvddate'];


$data = array('class' => 'form-control',
				'id' => 'ddate',
			  'name' => 'due_date',
			  'type'=>'date',
			  'value' => $val ,
			  'placeholder' => $val);


echo form_input($data,$val); 


echo form_label('(Must be <='.date('d/m/Y',strtotime($ddlbl)).')');



if (isset($_POST["status"])) 
{
	#	echo "post[status] found defined & status=".$_POST["status"];

	if ( $this->session->userdata['task']["status"] == 2 || $this->session->userdata['task']["status"] == 3  || $_POST["status"]== 2 || $_POST["status"]== 3)
	{
		
		echo "<script language=\"javascript\">console.log(\"testing\");dditm=document.getElementById('ddatediv');dditm.classList.remove('ddatediv');console.log(\"end of script\");</script>";
	}
}
else
{
		#		echo "post[status] NOT found defined but userdata[status]=".$this->session->userdata['task']["status"];
		if ( $this->session->userdata['task']["status"] == 2 || $this->session->userdata['task']["status"] == 3  )
		{

	
			echo "<script language=\"javascript\">console.log(\"testing\");dditm=document.getElementById('ddatediv');dditm.classList.remove('ddatediv');console.log(\"end of script\");</script>";
		}
}

?>

</div>

<div class="form-group">


<?php 

$data = array('class' => 'form-control',
			  'name' => 'approved');
?>

<?php echo form_hidden($data,$this->session->userdata['task']["approved"]);  ?>



</div>
</div>

<div class="col-xs-12">

<div class="col-xs-7" style="margin-left:0px;">

<?php echo form_label('Latest Update'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'latest_update',
			  'placeholder' => 'updates....',
			'rows'=>2);
?>

<?php echo form_textarea($data,$this->session->userdata['task']["latest_update"]);  ?>


</div>

</div>



<div  class="col-xs-12" id="savediv" >

<div class="col-xs-4" style="text-align: center;margin-top:25px;">


<?php 

$data = array('class' => 'btn btn-success btn-lg',
			  'name' => 'save',
			  'value' => 'Save');

$attributes = array('id'=>'save');
echo form_submit($data,'','" id="save" ');  

?>

</div>

<div class="col-xs-4" style="text-align:left center;margin-top:25px;">

<?php 

$data = array('class' => 'btn btn-success btn-lg',
			  'name' => 'cancel',
			  'value' => 'Cancel');

$js = 'onClick="cancel_func()"';
echo form_input($data,"",$js);  
?>


</div>

</div>


<script type="text/javascript">

function cancel_func() {
	window.location.replace("http://localhost/ci/projects");
}


</script>





<!-- <?php echo form_close(); ?> -->
</div>
</div>
</body>


</html>