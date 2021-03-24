<h2>Create Projects Form</h2>


<?php if($this->session->flashdata('taskerrors')): ?>
		<?php echo $this->session->flashdata('taskerrors') ?>

<?php endif; ?>

<?php $attributes = array('id'=>'task_form','class'=> 'form_horizontal'); ?>




<?php echo form_open('tasks/validate_task',$attributes); ?>


<div class="form-group">

<?php echo form_label('name'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'name',
			  'placeholder' => 'Task Name');
?>

<?php echo form_input($data);  ?>


</div>


<div class="form-group">

<?php echo form_label('description'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'description',
			  'placeholder' => 'Task Description');
?>

<?php echo form_textarea($data);  ?>



</div>

<div class="form-group">

<?php echo form_label('Due Date'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'due_date',
			  'type'=>'date');
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