<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Login_test extends TestCase
{

	public function test_login()

	{
		 $params=['username'=>'mani',
                        'password'=>'123'];


                $output=$this->request('POST','users/login',$params);
		 echo "output=".$output;
		 $logged_in=$_SESSION['logged_in'];
		 echo "logged_in=".$logged_in;
		$this->assertStringContainsString('1',$logged_in);

	} 

}
