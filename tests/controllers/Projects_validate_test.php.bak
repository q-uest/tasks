<?php


class Projects_validate_test extends TestCase
{
	function testDataProcessorProcess_Subclass()
	{
		$mock_dr = $this->createMock("Projects");

	
		$mock_dr->expects($this->any())
		->method("validate")
		->will($this->returnValue('true'));

	
		echo " mock_dr@DataProcessorTest_test=".$mock_dr->validate();

		$result=$mock_dr->validate();	
	
		$this->assertEquals('true', $result); 
	}
}


?>
