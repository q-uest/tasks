<?php if($this->session->userdata('logged_in')): ?>

<h2>Logout</h2>

<?php echo form_open('users\logout'); ?>
<p>
<?php echo "You are logged in as ".$this->session->userdata('username'); ?>
</p>

<?php 

	$data = array(
	'class'=>'btn btn-primary',
	'name'=>'submit',
	'value'=>'Logout'
	);

?>


<?php echo form_submit($data); ?>

<?php echo form_close(); ?>

<?php else: ?>

 <h2>Login Form for Praveen Demo</h2>


<?php $attributes = array('id'=>'login_form','class'=> 'form_horizontal'); ?>


<?php echo form_open('users/login',$attributes); ?>


<div class="form-group">

<?php echo form_label('Username'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'username',
			  'placeholder' => 'Enter Username');
?>

<?php echo form_input($data);  ?>

</div>

<div class="form-group">


<?php echo form_label('Password'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'password',
			  'placeholder' => 'Enter Password');
?>



<?php echo form_password($data);  ?>

</div>

<!-- <div class="form-group">


<?php echo form_label('Confirm Password'); ?>

<?php 

$data = array('class' => 'form-control',
			  'name' => 'Confpswd',
			  'placeholder' => 'Confirm Password');
?>

<?php echo form_password($data);  ?>

</div>
 -->
<div class="form-group">

<?php 

$data = array('class' => 'btn btn-primary',
			  'name' => 'submit',
			  'value' => 'Login');
?>

<?php echo form_submit($data);  ?>


</div>

<?php echo form_close(); ?>


<?php endif; ?>
