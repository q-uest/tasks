
 <h2>Edit Projects Form</h2>

<?php echo "dml_op=".$this->session->userdata('dml_op'); ?>

	    	
<?php if($this->session->flashdata('projerr')): ?>
		<?php echo $this->session->flashdata('projerr') ?>

<?php endif; ?>

<?php $attributes = array('id'=>'edit_proj','class'=> 'form_horizontal'); ?>




<?php echo form_open('projects/validate',$attributes); ?>


<div class="form-group">

<?php echo form_label('name'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'name',
			  'value' => $project_data->project_name);


 echo form_input($data); 


?>

</div>


<div class="form-group">

<?php echo form_label('description'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'description',
			  'value' => $project_data->project_body);


echo form_textarea($data);   

?>

</div>


<div class="form-group">

<?php 

$data = array('class' => 'btn btn-primary',
			  'name' => 'Update',
			  'value' => 'Update');
?>

<?php echo form_submit($data);  ?>


</div>

<?php echo form_close(); ?>