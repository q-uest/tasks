

<?php
	echo "view_errors.php called...";
	if($this->session->flashdata('regerr')):
		echo $this->session->flashdata('regerr');
	endif;
?>

