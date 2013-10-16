<?php
class HeaderMenuWidgetTest extends CDbTestCase{
	
	public function dataForSetActiveCategoryTest(){
		return array(
			array(10),
			array('production'),
			array('-=-dffdf'),
		);
	}
	
	/**
	 * @dataProvider dataForSetActiveCategoryTest
	 */
	public function setActiveCategoryTest($activeCategory){
		
	}
}
?>
