<?php
class UserTest extends CDbTestCase
{
	public $fixtures = array(
		'users' => 'User',
	);	
	
	public function method1(){
	    return array(array(1),array(2));
	}
	
	
	/**
	 * @dataProvider method1
	 */
	public function testMethod1($a){
	    $this->assertEquals(1,$a);
	    //$this->assertNotEmpty($a);
	    //$this->assertEmpty($a);
	    $testArr = array();
	    return $testArr;
	}
	
	/**
	 * @dataProvider method1
	 */
	public function testMethod2($a){
	   $this->assertEmpty($a);
	    //$testArr = array();
	    return $testArr;
	}
	
	
		
//	public function testChangePassword()
//	{
//		$user=$this->users;
//		$user->password=$user->hashPassword('newpwd');
//		$this->assertFalse($user->validatePassword('demo'));
//		$this->assertTrue($user->validatePassword('newpwd'));
//
//	}
}