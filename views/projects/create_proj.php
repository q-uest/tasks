 <h2>Create Projects Form</h2>


<?php if($this->session->flashdata('projerr')): ?>
		<?php echo $this->session->flashdata('projerr') ?>

<?php endif; ?>

<?php $attributes = array('id'=>'proj_form','class'=> 'form_horizontal'); ?>




<?php echo form_open('projects/validate',$attributes); ?>


<div class="form-group">

<?php echo form_label('name'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'name',
			  'placeholder' => 'Project Name');
?>

<?php echo form_input($data);  ?>


</div>


<div class="form-group">

<?php echo form_label('description'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'description',
			  'placeholder' => 'Project Description');
?>

<?php echo form_textarea($data);  ?>



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