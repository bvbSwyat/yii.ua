<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include applcation.tests.unit.MyClass;
/**
 * Description of StubTest
 *
 * @author swyat
 */
class StubTest extends CDbTestCase{
    public function testNewStub(){
	$stub = $this->getMock('MyClass');
	    $stub->expects($this->any())
		    ->method('getReturnVal')
		    ->will($this->returnValue(123));
	    $this->assertEquals('1234', $stub->getReturnVal());
    }
}

?>
