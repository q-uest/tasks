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
	#background-color:white;
	color: white;
		}

</style>

</head>

<body>

<div class="container">

<div class="col-xs-5">



<?php 
echo "<h3>Tasks for <b>".$this->session->userdata('project_data')->project_name."</b></h3>"; 
?>


<?php if($this->session->flashdata('taskerrors')): ?>
		<?php echo $this->session->flashdata('taskerrors') ?>

<?php endif; ?>

<?php $attributes = array('id'=>'task_form','class'=> 'form_horizontal'); ?>



<?php echo form_open('tasks/validate_task',$attributes); ?>


<div class="form-group">


<?php 

if (isset($_POST["name"]))
	$pname=$_POST["name"];
else
	$pname="";

$data = array('class' => 'form-control',
			  'name' => 'name',
			  'placeholder' => "Task Name",
			  'value' => $pname
			);
#set_value('name',$_POST["name"] );

#echo '$_POST["name"]='.$_POST["name"];
?>



<?php echo form_input($data);  ?>



</div>


<div class="form-group">

<?php echo form_label('Description'); ?>

<?php 

if (isset($_POST["description"]))
	$pdescription=$_POST["description"];
else
	$pdescription="";


$data = array('class' => 'form-control',
			  'name' => 'description',
			  'placeholder' => 'Task Description',
			  'value' => $pdescription,
			'rows'=>2);
?>

<?php echo form_textarea($data);  ?>



</div>

<div class="form-group">

<?php echo form_label('To Be Completed Before [ Should be <'.$this->session->userdata['vddate'][0]['ddate'].' & >'.$this->session->userdata['cdate'][0]['today'].' ]'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'due_date',
			  'type'=>'date',
			  'value' => $this->session->userdata['vddate2']
			);

#echo "vdue_Date=".$this->session->userdata['vddate2'];

?>

<?php echo form_input($data,$this->session->userdata['vddate2']);  ?>



</div>


<div class="form-group">

<!--<?php echo form_label('Parent Task'); ?> -->

<?php 

$data = array('class' => 'form-control',
			  'name' => 'parent_task_id',
			  'value' =>  $this->session->userdata['vparent_task_id'],
			  'placeholder' => $this->session->userdata['vparent_task_id']
			);

$data = ['parent_task_id'=>$this->session->userdata['vparent_task_id']];
			  
?>

<?php echo form_hidden($data,$this->session->userdata['vparent_task_id']);  ?>






<div class="form-group">

<?php 


if ($this->session->userdata('approved')==0)
{

	echo form_label('Assigned to'); 

	$data=array('class' => 'form-control',
			  'name' => 'userid',
			  'placeholder' => 'Choose userid');

	$options=array();

	foreach ($this->session->userdata('user_data') as $user)
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

<!-- <?php echo form_label('Group ID'); ?> -->

<?php 

$data = array('class' => 'form-control',
			  'name' => 'groupid',
			  'placeholder' => $this->session->userdata('vgroupid'));

$data = ['groupid' => $this->session->userdata('vgroupid')]
?>

<?php echo form_hidden($data,$this->session->userdata('vgroupid'));  ?>



</div>
<div class="form-group">


<?php 

$data = array('class' => 'form-control',
			  'name' => 'approved');

echo form_hidden('approved',$this->session->userdata('approved')); 
			  
?>

</div>

<div class="form-group"  >



<?php

	echo form_label('Dependent on Tasks'); 	

	$data=array('class' => 'form-control',
			  'name' => 'depends_on_task[]'
				);

	$selected=array();
	
	foreach ($this->session->userdata('task_data') as $task)
	{
	
		#echo "<option value=".$options[$task['id']].">".$task['task_name']."</option>";
	
		$selected[$task['id']]=$task['task_name'];
	}

	#echo form_input($task,'class="form-control"'); 	
	echo form_multiselect('depends_on_task[]', $selected, set_value('depends_on_task'),"class='css-style col-xs-12'");
?>

</div>

<div class="form-group col-xs-10">
<div class="col-xs-5" style="margin-top:20px;left:45%">
<?php 

$data = array('class' => 'btn btn-success btn-lg',
			  'name' => 'save',
			  'value' => 'Save');
?>

<?php echo form_submit($data);  ?>
</div>


<!-- <?php echo form_close(); ?> -->
</div>
</div>
</body>


</html>