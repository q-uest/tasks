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
	#msgdiv {
		margin-top: 150px;
		
		height: 250px;
		width: 1000px;
		border: 0.1px solid white;
		vertical-align: middle;
		text-align: center;
		font-size: 30px;

	}
	#flag {

		color: red;
	}

	#msg {
		margin-top:25px;
		margin-bottom: 50px;
	}

</style>

</head>

<body>

<div class="container">

<div id="msgdiv" class="col-xs-12">



<?php 
echo "<div id='msg'> <b><span id='flag' class='glyphicon glyphicon-flag'></span>
You are Not Authorised to perform this operation on this task!
Check with the owner !</b> </div>"; 
?>

<?php $attributes = array('id'=>'task_form','class'=> 'form_horizontal'); ?>

<?php echo form_open('projects',$attributes); ?>

<div class="form-group">

<?php 

$data = array('class' => 'btn btn-success btn-lg',
			  'name' => 'B2Projects',
			  'value' => 'Back to Projects');
?>

<?php echo form_submit($data);  ?>
</div>





</div>
</div>
</body>


</html>