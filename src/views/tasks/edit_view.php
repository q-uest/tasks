<h2>Edit Task</h2>


<?php if($this->session->flashdata('taskerr')): ?>
		<?php echo $this->session->flashdata('taskerr') ?>

<?php endif; ?>

<?php $attributes = array('id'=>'task_form','class'=> 'form_horizontal'); ?>




<?php echo form_open('tasks/validate_upd_task',$attributes); ?>


<div class="form-group">

<?php echo form_label('name'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'name',
			  'value' => $task [0]->task_name);
?>

<?php echo form_input($data);  ?>


</div>


<div class="form-group">

<?php echo form_label('description'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'description',
			  'value' => $task [0]->task_body);
?>

<?php echo form_textarea($data);  ?>



</div>

<div class="form-group">

<?php echo form_label('Due Date'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'due_date',
			  'value'=> $task [0]->due_date);
?>

<?php echo form_input($data);  ?>



</div>


<div class="form-group">

<?php 

$data = array('class' => 'btn btn-primary',
			  'name' => 'save',
			  'value' => 'Save');
?>

<?php echo form_submit($data);  ?>


</div>

<?php echo form_close(); ?>