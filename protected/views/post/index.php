<?php
/* @var $this PostController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Posts',
);

$this->menu=array(
	array('label'=>'Create Post', 'url'=>array('create')),
	array('label'=>'Manage Post', 'url'=>array('admin')),
);
?>
<?php $this->widget('zii.widgets.CMenu',array(
   'items'=>array(
      array('label'=>'Home', 'url'=>array('/site/index')),
      array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
      array('label'=>'Contact', 'url'=>array('/site/contact')),
      array('label'=>'jqSlideMenuTest', 'url'=>array('#'), 
        'items'=>array(
           array('label'=>'Home', 'url'=>array('/site/index')),
           array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
           array('label'=>'Contact', 'url'=>array('/site/contact'), 
              'items'=>array(
                  array('label'=>'Home', 'url'=>array('/site/index')),
                  array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                  array('label'=>'Contact', 'url'=>array('/site/contact'),
                      'items'=>array(
                          array('label'=>'Home', 'url'=>array('/site/index')),
                          array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                          array('label'=>'Contact', 'url'=>array('/site/contact')),
                       )),
                  )),
              )),   
       array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
       array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)),
     )); ?>
<br style="clear: left" />
 
</div><!-- myslidemenu-->
<h1>Posts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
