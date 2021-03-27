<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Users_test extends TestCase
{

	public function users_login()

	{
		$params=['username'=>'mani',
			'password'=>'123'];


		$output=$this->request('POST','users/login',$params);
		echo "output=".$output;
		$this->assertStringContainsString('user_id check is through',$output);

	} 

}
