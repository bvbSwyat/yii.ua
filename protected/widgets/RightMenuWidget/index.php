<?php
	$widget = $this->beginWidget('zii.widgets.CListView', array(
	    'dataProvider' 		=> $categoriesArray,
	    'enablePagination'  	=> true,
	    'pager'			=> array('class' => 'Pager', 'templateName' => 'pager_new',),
	    'ajaxUpdate' 		=> null,
	    'itemView' 			=> 'application.widgets.HeaderMenuWidget.categories.categories_view',
	    'template' 			=> ''/*{summary}\n{sorter}\n{items}\n{pager}*/,
	    
	));
	$widget->renderItems();	
	$this->endWidget();
	
