<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Projects_test extends TestCase
{

	public function test_projects()
	{
		$_SESSION['logged_in']=1;
		$_SESSION['dml_op'] = 'I';
		$_SESSION['user_id'] = 28;

		$params=['name'=>'Unit Test',
                        'description'=>'Unit Test description'];


		$output=$this->request('POST','projects/validate',$params);
		echo "output=".$output;
#		echo "errdata=".$_SESSION['errdata'];
		echo "project_inserted".$_SESSION['project_inserted'];
		$this->assertStringContainsString('28',$_SESSION['user_id']);

	} 

}

?>
