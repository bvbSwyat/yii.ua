<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductionController
 *
 * @author swyat
 */
class ProductionController extends Controller{
    
    //public $layout='//layouts/column2';
    
    public function actionIndex($brand){
	echo $brand;
    }
    public function actionBrand($name){
	    echo $name;
	    $this->render('index',array(
			'name'=>$name,
                    ));
    } 
}

?>
