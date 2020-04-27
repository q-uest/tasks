<div class="col-xs-9">



<?php echo "<h1>Project Name:". $project_data->project_name ."</h1>"?>
<?php echo  "Created Date:".$project_data->created_date; ?>
<?php echo  "<h1>Description:</h1><h3>". $project_data->project_body ."</h3>" ?>

</div>

<div class="col-xs-3">
<ul class="list-group">
	<h3>Project Actions</h3>

	<li class="list-group-item"><?php echo "<a href=".base_url()."tasks/cre_task/".$project_data->id.">"?>Create Tasks</a></li>
	<li class="list-group-item"><?php echo "<a href=".base_url()."projects/upd_proj/".$project_data->id.">"?>Edit Project</a></li>
	<li class="list-group-item"><?php echo "<a href=".base_url()."projects/del_proj/".$project_data->id.">"?>Delete Project</a></li>
	 
</ul>

</div>





<div class="col-xs-12">




<br>
<br>


<br>
<br>



<p>
<?php 

	if($this->session->flashdata('task_inserted'))
	{

		echo $this->session->flashdata('task_inserted');

	}
?>

<?php
			
	if($this->session->flashdata('task_deleted'))
	{

		echo $this->session->flashdata('task_deleted');

	}
	

?>

</p>
<a href="<?php echo base_url()."tasks/cre_task/".$project_data->id?>"><button type="button" class="btn btn-primary btn-lg">Add Tasks</button></a>

<?php if($task_data): ?>

<div>

<table class="table table-bordered">
	<thead>
	<tr>
		<th>
		Task Name
		</th>
		<th>
		Description
		</th>
		<th>
		Due Date
		</th>
		<th>
		Action
		</th>
	</tr>
	</thead>
	<tbody>
		
		<?php foreach($task_data as $task): ?>
		<tr>
		<?php echo "<td><a href='". base_url() ."tasks/display/". $task->id ."'>".$task->task_name . "</a></td>"?>
		<?php echo "<td>".$task->task_body; "</td>"?>
		<?php echo "<td>".$task->due_date; "</td>"?>


		<td><a class="btn btn-danger" href='<?php echo base_url() ."tasks/del_task/". $task->id ?>'><span class="glyphicon glyphicon-remove"></span></a>
		<a class="btn btn-success" href='<?php echo base_url() ."tasks/upd_task/". $task->id ?>'><span class="glyphicon glyphicon-edit"></span></a></td>


		</tr>


		<?php endforeach; ?>

	</tbody>

</table>

</div>
</div>

<?php endif; ?>
