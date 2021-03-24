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





<?php 
echo "<h3>Tasks for <b>".$this->session->userdata('project_data')->project_name."</b></h3>"; 
?>


<div class="col-xs-12" style="margin-top:40px;margin-left: 0px;padding-left:0px;"  >

<?php if($this->session->flashdata('taskerrors')): ?>
		<?php echo $this->session->flashdata('taskerrors') ?>

<?php endif; ?>

<?php $attributes = array('id'=>'task_form','class'=> 'form_horizontal'); ?>



<?php echo form_open('tasks/validate_task',$attributes); ?>

<!-- <div class="form-group"> -->


<div class="col-xs-6" style="padding-right:50px;border-right:0.5px solid #c2bbb4;">

<?php 

echo form_label('Name'); 

if (isset($_POST["name"]))
	$pname=$_POST["name"];
else
	$pname="";

$data = array('class' => 'form-control',
			  'name' => 'name',
			  'placeholder' => "Task Name",
			  'value' => $pname
			);
?>


<?php echo form_input($data,"",'style="color:red;margin-bottom:40px;"');  ?>


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

<?php echo form_textarea($data,"",'style=margin-bottom:40px;');  ?>



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


<?php 


echo '<div class="col-xs-4" style="margin-bottom:20px;">';



########
# Tentative Start date
#########################

echo "<div class='col-xs-12'>";
echo form_label('Tentative Start Date'); 
 
if (isset($_POST["tentative_start_date"]))
	$tsd=$_POST["tentative_start_date"];
else
	$tsd=$this->session->userdata['main_task'][0]['tentative_start_date'];



$data = array('class' => 'form-control',
			  'name' => 'tentative_start_date',
			  'type'=>'date',
			  'value'=>$tsd
			 );


echo form_input($data,"",'style=margin-bottom:5px;');  

#echo form_label("between ".$this->session->userdata['cdate'][0]['today'].' & '.$this->session->userdata['vddate'][0]['ddate']);

echo "</div>";

######
# tentative due date
##########################

echo "<div class='col-xs-12' style='margin-top:40px;'>";

echo form_label('Tentative Due Date',''); 


if (isset($_POST["tentative_due_date"]))
	$ted=$_POST["tentative_due_date"];
else
	$ted=$this->session->userdata['main_task'][0]['tentative_due_date'];

 

$data = array('class' => 'form-control',
			  'name' => 'tentative_due_date',
			  'type'=>'date',
			  'value'=>$ted
			  );




echo form_input($data);  

#echo form_label('between '.$this->session->userdata['vddate'][0]['ddate'].' &'.' Tentative Start Date');

echo "</div>";


######
# Assigned to
#######################

if ($this->session->userdata('approved')==0)
{



	echo "<div class='col-xs-12' style='margin-top:60px;'>";

	echo form_label('Assign to'); 

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


echo "</div>";

echo "</div>";
?>






<!-- <div class="form-group"> -->




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


<div class="form-group col-xs-10">
<div class="col-xs-5" style="margin-top:30px;left:35%">
<?php 

$data = array('class' => 'btn btn-success btn-lg',
			  'name' => 'save',
			  'value' => 'Save');
?>

<?php echo form_submit($data);  ?>

</div>

<div class="col-xs-5" style="margin-top:30px;left:10%" >
<?php 

$data = array('class' => 'btn btn-success btn-lg',
			  'name' => 'cancel',
			  'value' => 'Cancel');

$js = 'onClick="cancel_func()"';
echo form_input($data,"",$js);  
?>


</div>




<!-- <?php echo form_close(); ?> -->
</div>
</div>

<script type="text/javascript">

function cancel_func() {
	window.location.replace("http://localhost:8000/ci/projects");
}


</script>





</body>


</html>
