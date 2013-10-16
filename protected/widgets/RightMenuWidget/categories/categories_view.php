<?php

if($data['active'] === true){
	if($data['id_view'] === '0'){
		echo CHtml::link($data['category'], array('/'.$data['alias']),array('class' => 'selected'));
	}
	else{
		echo CHtml::link($data['category'], array('class' => 'selected'));
		if (!empty($data->Views->id)){
			require(YiiBase::getPathOfAlias('application.widgets.HeaderMenuWidget.subcategories').'/'.$data->Views->view.'.php');
		}
	}	
}
else{
	if($data['id_view'] === '0'){
		echo CHtml::link($data['category'], array('/'.$data['alias']));
	}
	else{
		echo CHtml::link($data['category'], array(''));
		if (!empty($data->Views->id)){
			require(YiiBase::getPathOfAlias('application.widgets.HeaderMenuWidget.subcategories').'/'.$data->Views->view.'.php');
		}
	}	
}


