<?php


class Projects_display_test extends TestCase
{

    public function test_projmock() {
	$mock_dr = $this->createMock("Project_model");

	
		$mock_dr->expects($this->any())
		->method("create_project")
		->will($this->returnValue(array('id'=>1,'task_name'=>'Task1')));

	
		#echo " mock_dr@DataProcessorTest_test=".$mock_dr->get_project(36);
		#
		#require_once '/var/www/html/prod/tasks/controllers/Projects.php';

		$proj = new Projects();

		$result=$mock_dr->get_projects();
		var_dump($result);
		
		echo "result=".$result['task_name'];	

	
		$this->assertEquals('Task1', $result['task_name']); 
}
}


?>
