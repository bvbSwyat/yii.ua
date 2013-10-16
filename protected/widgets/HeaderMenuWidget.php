<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */

/**
 * Description of HeaderMenu
 *
 * @author swyat
 * @email <s.boichuk@inbox.ru>	
 */
class HeaderMenuWidget extends CWidget {
    
        public $categoryName;
	public $subcategoryName;
	
	public function run(){		
		$dataMenu = $this->selectDataForMenu();
		$dataMenu = $this->setActiveCategory($this->categoryName, $dataMenu);
		$dataProvider = new CArrayDataProvider($dataMenu);
		$this->actionViewCategories($dataProvider);
	}
	
	public function selectDataForMenu(){
	    $criteria = new CDbCriteria();
	    $criteria->with =array('Subcategories','Views');
		$dataMenu = HeaderMenuCategories::model()->findAll($criteria);
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
