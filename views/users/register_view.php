

<?php	if($this->session->flashdata('regerr')): ?>
	

	
<?php	echo $this->session->flashdata('regerr'); ?>

	<?php endif; ?>


<div class="col-xs-12">

 <h1>User Registration</h1>

<div class="col-xs-8">

<?php $attributes = array('id'=>'register_form','class'=> 'form_horizontal'); ?>




<?php echo form_open('users/validate',$attributes); ?>

<div class="form-group">

<?php echo form_label('Firstname'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'first_name',
			  'placeholder' => 'Firstname');
?>

<?php echo form_input($data);  ?>

</div>

<div class="form-group">

<?php echo form_label('Lastname'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'last_name',
			  'placeholder' => 'Lastname');
?>

<?php echo form_input($data);  ?>


</div>

<div class="form-group">

<?php echo form_label('Email'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'email',
			  'placeholder' => 'Email');
?>

<?php echo form_input($data);  ?>


</div>


<div class="form-group">

<?php echo form_label('Username'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'username',
			  'placeholder' => 'Username');
?>

<?php echo form_input($data);  ?>


</div>

<div class="form-group">

<?php echo form_label('Password'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'password',
			  'placeholder' =>  'Password');
?>

<?php echo form_password($data);  ?>


</div>

<div class="form-group">

<?php echo form_label('Confirm Password'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'Confpswd',
			  'placeholder' => 'Confirm Password');
?>

<?php echo form_password($data);  ?>

</div>


<?php 
$data = array('class' => 'btn btn-primary',
			  'name' => 'submit',
			  'value' => 'Register');
?>


<?php echo form_submit($data);  ?>




<?php echo form_close(); ?>

