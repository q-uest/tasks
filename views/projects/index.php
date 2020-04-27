<h1>Projects</h1>

<p>

<?php 
if($this->session->flashdata('project_inserted'))
{

	echo $this->session->flashdata('project_inserted');
}

?>
</p>

<p>

<?php if($this->session->flashdata('project_updated'))
{

	echo $this->session->flashdata('project_updated');
}

?>

</p>

<p>

<?php if($this->session->flashdata('project_deleted'))
{
   echo $this->session->flashdata('project_deleted');
}

?>

</p>

<a class="btn btn-primary pull-right" href="<?php echo base_url(); ?>projects/create">Create Project </a>


	   						


<table class="table table-hover">
	<thead>
	<tr>
		<th>
		Project Name
		</th>
		<th>
		Description
		</th>
	</tr>
	</thead>
	<tbody>
		
		<?php foreach($projects as $project): ?>
		<tr>
		<?php echo "<td><a href='". base_url() ."projects/display/". $project->id ."'>".$project->project_name . "</a></td>"?>
		<?php echo "<td>".$project->project_body; "</td>"?>


		<td><a class="btn btn-danger" href='<?php echo base_url() ."projects/del_proj/". $project->id ?>'><span class="glyphicon glyphicon-remove"></span></a></td>

		</tr>


		<?php endforeach; ?>

	</tbody>

</table>

<?php 

   	
?>			
