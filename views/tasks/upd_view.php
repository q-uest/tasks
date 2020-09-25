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

</style>

</head>

<body>

<div class="container">

<div class="col-xs-5">



<?php 
//echo "<h3>Tasks for <b>".$this->session->userdata('project_data')->project_name."</b></h3>"; 
?>


<?php if($this->session->flashdata('errors')): ?>
		<?php echo $this->session->flashdata('errors') ?>

<?php endif; ?>

<?php $attributes = array('id'=>'task_form','class'=> 'form_horizontal'); ?>



<?php echo form_open('tasks/validate_upd_task',$attributes); ?>



<div class="form-group">



<?php 

#echo form_label('Task_id'); 

$data = array('class' => 'form-control',
			  'name' => 'task_id',
			  'value'=> $task[0]["id"]);
?>

<?php echo form_hidden($data,$task[0]["id"]);  ?>



</div>




<div class="form-group">



<?php 

echo form_label('Task'); 

$data = array('class' => 'form-control',
			  'name' => 'task_name',
			  'placeholder' => $task[0]["task_name"]);
?>

<?php echo form_input($data,$task[0]["task_name"]);  ?>



</div>


<div class="form-group">

<?php echo form_label('Description'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'description',
			  'placeholder' => 'Task Description',
			'rows'=>2);
?>

<?php echo form_textarea($data,$task[0]["task_body"]);  ?>



</div>

<div class="form-group">

<?php echo form_label('To Be Completed Before [Must be <'.$this->session->userdata['vddate'].' & >'.$this->session->userdata['today'].' ]'); ?>


<?php 

$data = array('class' => 'form-control',
			  'name' => 'due_date',
			  'type'=>'date',
			  'value' => $this->session->userdata['task']['defvddate'],
			  'placeholder' => $this->session->userdata['task']['defvddate']);
?>

<?php echo form_input($data,$this->session->userdata['task']['defvddate']);  ?>



</div>





<div class="form-group">

<?php 


if ($this->session->userdata('approved')==0)
{

	echo form_label('Assigned to'); 

	$data=array('class' => 'form-control',
			  'name' => 'userid',
			  'placeholder' => 'Choose userid');

	$options=array();

	foreach($user_data as $user)
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


<div class="form-group">

<?php 

echo form_label('Status'); 
#echo "Task's status=".$this->session->userdata['task']["status"];
if ($this->session->userdata['task']["status"] != 4 )
{
?>

<div class='form-group' id='statdiv'>


<?php 



$data = array('class' => 'form-control',
				'id' => 'status',
			  'name' => 'status');

 	$stoptions=array(1=>'Open',2 =>'In Progress',3 => 'Completed',4 => 'Unscheduled');
	echo form_dropdown('status', $stoptions,$task[0]["status"],'onChange="check_for_compl();" id="status" class="form-control"'); 	

 } 

 else 
 {

 	$data = array('class' => 'form-control',
				'id' => 'status',
			  'name' => 'status');

 	$stoptions=array(4=>'Unscheduled');
 	echo form_dropdown('status', $stoptions,$task[0]["status"],'id="status" class="form-control"');



 }

?>

<script type="text/javascript">

dditm=document.getElementById("status");
console.log("The script of onchange is firing..");
function check_for_compl() {
	cmtdiv=document.getElementById("cmtdiv");
	cmtcol=document.getElementById('clo_comments');
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

}


</script>





</div>

<?php if ($task[0]["status"]==3)
{
?>

<div class="form-group" id="cmtdiv" style="display:block">
<?php }

else
{
?>

<div class="form-group" id="cmtdiv" style="display:none">

<?php
}
?>

<?php echo form_label('Closing Comments'); 




$data = array('class' => 'form-control',
			  'name' => 'clo_comments',
			  'id'=>'clo_comments',
			  'placeholder' => 'Closing Comments',
				'rows'=>2);
?>

<?php echo form_textarea($data,$task[0]["clo_comments"]);  ?>

</div>



<div class="form-group">


<?php 

$data = array('class' => 'form-control',
			  'name' => 'approved');
?>

<?php echo form_hidden($data,$task[0]["approved"]);  ?>



<div class="form-group" id='statdiv'>

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

		echo "default selected=".$this->session->userdata['task']["depends_on_task"][0];
		echo form_multiselect('depends_on_task[]', $selected, $this->session->userdata['task']["depends_on_task"],"class='css-style col-xs-12' style='margin-bottom:20px;'");
	}
	else
	{
		echo form_multiselect('depends_on_task[]', $selected, NULL,"class='css-style col-xs-12' style='margin-bottom:20px;'");	
	}
?>

</div>




<div>



<?php echo form_label('Latest Update'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'latest_update',
			  'placeholder' => 'updates....',
			'rows'=>2);
?>

<?php echo form_textarea($data,$this->session->userdata['task']["latest_update"]);  ?>



</div>

<br>

<div class="form-group " id="savediv" style="text-align: center">
<!-- <div class="col-xs-5"> -->
<?php 

$data = array('class' => 'btn btn-success btn-lg',
			  'name' => 'save',
			  'value' => 'Save');
?>
<?php 
$attributes = array('id'=>'save');
echo form_submit($data,'','" id="save" ');  
?>
<!-- </div> -->





<!-- <?php echo form_close(); ?> -->
</div>
</div>
</body>


</html>