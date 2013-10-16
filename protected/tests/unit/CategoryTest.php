<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryTest
 *
 * @author swyat
 */
class CategoryTest extends CDbTestCase{
    /**
     * @var Category
     */
    protected $category;
    
    public $fixtures = array('categories' => 'Category');
    
    protected function setUp() {
	parent::setUp();
	$this->category = new Category();
    }
    
    public function testNameIsRequired(){
	$this->category->name = "";
	$this->assertFalse($this->category->validate(array("name")));
    }
    
    public function testNameMaxLengthIs150(){
	$this->category->name = $this->generateString(151);
	$this->assertFalse($this->category->validate(array("name")));
    
 	
	$this->category->name = $this->generateString(150);
	$this->assertTrue($this->category->validate(array("name")));
	    
    }
    
//    public function testBelongsToParent(){
//	$category = Category::model()->findByPk(2);
//	$this->assertInstanceOf('Category', $category->Product);
//    }
    
    public function generateString($length){
        $random= "";
        srand((double)microtime()*1000000);
        $char_list = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $char_list .= "abcdefghijklmnopqrstuvwxyz";
        $char_list .= "1234567890";
        // Add the special characters to $char_list if needed

        for($i = 0; $i < $length; $i++)
        {
            $random .= substr($char_list,(rand()%(strlen($char_list))), 1);
        }
        return $random;
    }
    
    public function testNewArray(){
	$array = array();
	$this->assertEmpty($array);
	return $array;
    }
    /**
     * @depends testNewArray
     */
    public function testSetDataInArray($array){
	$this->assertEmpty($array);
	$array = array(1,2,3,4);
	$this->assertNotEmpty($array);
	$this->assertEquals(2, $array[1]);
	return $array;
    }
    
    public function dataForOutputArray(){
	return array(
	    array('str2'),
	    array('str2'),
	    array('string1'),
	);
    }
    /**
     * @dataProvider dataForOutputArray
     */
    public function testOutputArray($array){
	//$array = 'string1';
	$this->expectOutputString($array);
	//$array = "string1";
	var_dump ($array);
    }
    
    public function keysForArrayKey(){
	return array(array(1),
		    array(2),
		    array(3));
    }

    /**
     * @dataProvider keysForArrayKey
     */
    public function testArrayKey($key){
	$array[$key] = 1234;
	$this->assertArrayHasKey(1,$array);
	$this->assertArrayNotHasKey(5,$array);
    }
    /**
     * @dataProvider keysForArrayKey
     */
    public function testArrayNotKey($key){
	$array[$key] = 1234;
	//$this->assertArrayHasKey(1,$array);
	$this->assertArrayNotHasKey(1,$array);
	//$this->assertCount(3,$array);
    }
    
    public function testCountArray(){
	$array = array('first'=>'123', 'second'=>'456');
	$this->assertCount(2,$array);
	return $array;
	
    }
    
    public function testEmptyArray(){
	$array = array();
	$this->assertEmpty($array);
    }
    
    /**
     * @depends testCountArray
     */
    public function testNotEmptyArray($array){
	//$array = array();
	$this->assertNotEmpty($array);
    }
    public function dataForTestEquals(){
	return array(
	    array(1,2),
	    array(0,0),
	    array(2+3,10-5),
	);
    }
    /**
     * @dataProvider dataForTestEquals
     */
    public function testEquals($paramA, $paramB){
	$this->assertEquals($paramA, $paramB);	
    }
  
}

?>
