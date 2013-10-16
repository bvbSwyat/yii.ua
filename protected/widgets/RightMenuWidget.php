<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */

/**
 * Description of RightMenu
 *
 * @author swyat
 * @email <s.boichuk@inbox.ru>	
 */
class RightMenuWidget extends CWidget {
    
        public $action;
	public $brandName;
	
	public function run(){		
		if (!empty($this->brandName['name']) && ($this->action == 'brand')){
			$this->brandName = $this->brandName['name'];
			$categories = $this->selectDataForMenu();
			foreach ($categories as $category)
		    var_dump($category['category']);
		}
	}
	
	public function selectDataForMenu(){
	    $criteria = new CDbCriteria();
		$dataMenu = RightMenuCategories::model()->findAll($criteria);
		return $dataMenu;
	}

	/**
	 * Функція добавляє поле до кожної категорії, 1 - в разі активної, інакше - 0
	 * @param string $activeCategory -  
	 * @return array $categories - 
	 * @throws CException - 
	 */
	public function setActiveCategory($activeCategory,$dataMenu){
		if(!empty ($dataMenu)){
			foreach($dataMenu as $category){
				if($category['alias'] == $activeCategory){
					$category['active'] = true;
				}
				else{
					$category['active'] = false;
				}
			}
			return $dataMenu;
		}
		else{
			throw new CException('Помилка загрузки меню');
		}
	}
		
	/**
	 * Функція виводу категорій меню.
	 * 
	 * @param array $categoriesArray - масив із категоріями
	 */
	public function actionViewCategories($categoriesArray){
		$this->render('application.widgets.HeaderMenuWidget.index', array('categoriesArray' => $categoriesArray));
	}
}

?>
