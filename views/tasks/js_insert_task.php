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

<div class="col-xs-10">



<?php 
echo "<h3>Tasks for <b>".$this->session->userdata('project_data')->project_name."</b></h3>"; 
?>


<?php if($this->session->flashdata('taskerrors')): ?>
		<?php echo $this->session->flashdata('taskerrors') ?>

<?php endif; ?>

<?php $attributes = array('id'=>'task_form','class'=> 'form_horizontal'); ?>



<?php echo form_open('tasks/validate_task',$attributes); ?>


<div class="form-group">

<?php echo form_label(''); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'name',
			  'placeholder' => 'Task Name');
?>

<?php echo form_input($data);  ?>


</div>


<div class="form-group">

<?php echo form_label(''); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'description',
			  'placeholder' => 'Task Description',
			'rows'=>2);
?>

<?php echo form_textarea($data);  ?>



</div>

<div class="form-group">

<?php echo form_label(''); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'due_date',
			  'type'=>'date');
?>

<?php echo form_input($data);  ?>



</div>


<div class="form-group">

<?php 

$data = array('class' => 'btn btn-success btn-lg',
			  'name' => 'save',
			  'value' => 'Save');
?>


<?php echo form_submit($data);  ?>


<div class="form-group">
<?php 

$data = array('class' => 'btn btn-success btn-lg',
			  'name' => 'save-n-close',
			  'id' => 'snc',
			  'value' => 'Save & Close');
?>



<?php echo form_submit($data);  ?>

<script> type="text/javascript" 
	
		document.getElementById('snc').addEventListener('click',function()
			{
				taskwin=window.open('tasks/validate_task',$data);
				
			}
		);
	
</script>


</div>

<?php echo form_close(); ?>
</div>
</div>
</body>


</html>