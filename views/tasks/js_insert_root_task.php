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



<?php echo form_open('tasks/validate_root_task',$attributes); ?>


<div class="form-group">


<?php 

if (isset($_POST["name"]))
	$pname=$_POST["name"];
else
	$pname="";

$data = array('class' => 'form-control',
			  'name' => 'name',
			  'placeholder' => "Task Name",
			  'value' => $pname
			);
#set_value('name',$_POST["name"] );

#echo '$_POST["name"]='.$_POST["name"];
?>



<?php echo form_input($data);  ?>



</div>


<div class="form-group">

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

<?php echo form_textarea($data);  ?>



</div>


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

</div>





<?php 


if ($this->session->userdata('approved')==0)
{
	echo "<div class='form-group'>";

	echo form_label('Assigned to'); 

	$data=array('class' => 'form-control',
			  'name' => 'userid',
			  'placeholder' => 'Choose userid');

	$options=array();

	foreach ($this->session->userdata('user_data') as $user)
	{
		$options[$user['id']]=$user['username'];
	}

	echo form_dropdown('userid', $options,$this->session->userdata('user_id'), 'class="form-control"'); 	

 echo "</div>";

########
# Tentative Start date
#########################

echo "<div>";
echo form_label('Tentative Start Date'); 
 
if (isset($_POST["tentative_start_date"]))
	$ptsd=$_POST["tentative_start_date"];
else
	$ptsd="";


$data = array('class' => 'form-control',
			  'name' => 'tentative_start_date',
			  'type'=>'date',
			  'value'=>$ptsd
			 );


echo form_input($data,"",'style=margin-bottom:5px;');  


echo "</div>";

######
# Tentative End date
##########################

echo "<div  style='margin-top:0px;'>";

echo form_label('Tentative End Date',''); 


if (isset($_POST["tentative_end_date"]))
	$pted=$_POST["tentative_end_date"];
else
	$pted="";



$data = array('class' => 'form-control',
			  'name' => 'tentative_end_date',
			  'type'=>'date',
			  'value'=>$pted
			  );




echo form_input($data);  
echo "</div>";

}
else
{
	echo form_hidden('userid',$this->session->userdata('user_id')); 		
}

?>


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





<div class="form-group col-xs-10">
<div class="col-xs-5">
<?php 

$data = array('class' => 'btn btn-success btn-lg',
			  'name' => 'save',
			  'value' => 'Save');
?>

<?php echo form_submit($data);  ?>


</div>

<div class="col-xs-5">
<?php 

$data = array('class' => 'btn btn-success btn-lg',
			  'name' => 'cancel',
			  'value' => 'Cancel');
?>

</div>


<!-- <?php echo form_close(); ?> -->
</div>
</div>
</body>


</html>