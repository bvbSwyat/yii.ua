<?php

//echo $data->Views->id;
echo '<hr>';
foreach ($data->Subcategories as $subcategory){
		
		echo CHtml::link($subcategory['subcategory'], array($data['alias'].'/'.$subcategory['alias']));
		echo '</br>';
		//echo $subcategory['subcategory'].'</br>';
		//echo $subcategory['alias'].'</br>';
	}
	echo '<hr>';
?>
