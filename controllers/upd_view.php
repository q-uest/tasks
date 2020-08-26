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
echo "<h3>Tasks for <b>".$this->session->userdata('project_data')->project_name."</b></h3>"; 
?>


<?php if($this->session->flashdata('taskerrors')): ?>
		<?php echo $this->session->flashdata('taskerrors') ?>

<?php endif; ?>

<?php $attributes = array('id'=>'task_form','class'=> 'form_horizontal'); ?>



<?php echo form_open('tasks/validate_task',$attributes); ?>


<div class="form-group">


<?php 

$data = array('class' => 'form-control',
			  'name' => 'name',
			  'placeholder' => 'Task Name');
?>

<?php echo form_input($data);  ?>



</div>


<div class="form-group">

<?php echo form_label('Description'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'description',
			  'placeholder' => 'Task Description',
			'rows'=>2);
?>

<?php echo form_textarea($data,$task['task_body']);  ?>



</div>

<div class="form-group">

<?php echo form_label('To Be Completed on'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'due_date',
			  'placeholder' => $task['due_date']);
?>

<?php echo form_input($data,$task['due_date']);  ?>



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

<?php echo form_label('Group ID'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'groupid',
			  'placeholder' => $_GET['groupid']);
?>

<?php echo form_input($data,$_GET['groupid']);  ?>



</div>
<div class="form-group">


<?php 

$data = array('class' => 'form-control',
			  'name' => 'approved',
			  'placeholder' => "1");

echo form_hidden('approved',$this->session->userdata('approved')); 
			  
?>




<div class="form-group col-xs-10">
<div class="col-xs-5">
<?php 

$data = array('class' => 'btn btn-success btn-lg',
			  'name' => 'save',
			  'value' => 'Save');
?>

<?php echo form_submit($data);  ?>
</div>





#<?php echo form_close(); ?>
</div>
</div>
</body>


</html>