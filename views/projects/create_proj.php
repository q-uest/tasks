

<?php if($this->session->flashdata('projerr')): ?>
		<?php echo $this->session->flashdata('projerr') ?>

<?php endif; ?>

<?php $attributes = array('id'=>'proj_form','class'=> 'form_horizontal'); ?>


<div class="col-xs-12">

<div class="col-xs-12">
<h2> Create Projects</h2>
</div>


<?php echo form_open('projects/validate',$attributes); ?>


<div class="col-xs-7" style="margin-top: 25px;">


<div class="form-group">

<?php echo form_label('Name'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'name',
			  'placeholder' => 'Project Name'
			);
?>


<?php echo form_input($data);  ?>

</div>

</div>


<div class="form-group">

<div class="col-xs-7">

<?php echo form_label('Description'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'description',
			  'placeholder' => 'Project Description',
			  'rows'=>3);
?>

<?php echo form_textarea($data);  ?>


</div>
</div>


<div class="form-group">

<div class="col-xs-12" style="margin-top:20px;">
<?php 

$data = array('class' => 'btn btn-primary',
			  'name' => 'save',
			  'value' => 'Save');
?>

<?php echo form_submit($data);  ?>

</div>

</div>

<?php echo form_close(); ?>