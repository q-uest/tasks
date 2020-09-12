<?php


	if($this->session->flashdata('user_registered')):
		echo $this->session->flashdata('user_registered');
	endif;


	#if($this->session->flashdata('login_success')):
	#	echo $this->session->flashdata('login_success');
	#endif;


	if($this->session->flashdata('login_failure')):
		echo $this->session->flashdata('login_failure');
	endif;


	if($this->session->flashdata('no_access')):
		echo $this->session->flashdata('no_access');
	endif;


?>

<?php if($this->session->userdata('logged_in')): ?>

<table style="width:75%;" class="table table-hover">
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


		<td><a class="btn btn-success" href='<?php echo base_url() ."projects/display/". $project->id ?>'>View</a></td>

		</tr>


		<?php endforeach; ?>

	</tbody>

</table>

<?php endif; ?>


