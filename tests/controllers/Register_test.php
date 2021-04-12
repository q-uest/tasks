<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Register_test extends TestCase
{

	public function test_register()

	{
		$params=['username'=>'mani',
                        'password'=>'123'];

                $output=$this->request('POST','users/login',$params);

		$params=['first_name'=>'test1',
			'last_name'=>'test1',
			'email'=>'test1@test1.com',
			'username'=>'test1',
			'password'=>'123',
			'Confpswd'=>'123' ];
		
		$this->request('POST','users/validate',$params);
		$this->assertStringContainsString('User has been registered',$_SESSION['user_registered']);

	} 

}
