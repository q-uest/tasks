<?php

class DataReader
{
public function readData()
{
	$json = '{"data": [1,2,3]}';
	echo "json returns...".$json;
return $json;
}
}

class DataProcessor
{
public function process(DataReader $dr)
{
$json_data = $dr->readData();
$data = json_decode($json_data);
return $data;
}
}



class TestableDataProcessor extends DataProcessor
{
#public $mock_dr;

#protected function _newDataReader()
#{
#return $this->mock_dr;
#}
}

class DataProcessorTest_test extends TestCase
{
	function testDataProcessorProcess_Subclass()
	{
		$mock_dr = $this->createMock("DataReader");

	
		$mock_dr->expects($this->any())
		->method("readData")
		->will($this->returnValue('{"data": [4,5,6]}'));

	
		echo " mock_dr@DataProcessorTest_test=".$mock_dr->readData();

	
		$dp = new TestableDataProcessor();
	#	$dp->mock_dr = $mock_dr;
		$result = $dp->process($mock_dr);

	
		$this->assertInstanceOf("stdClass", $result); 
		$this->assertCount(3, $result->data); 
		$this->assertEquals(4, $result->data[0]); 
		$this->assertEquals(5, $result->data[1]); 
		$this->assertEquals(6, $result->data[2]);
	}
}


?>
