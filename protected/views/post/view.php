<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Post', 'url'=>array('index')),
	array('label'=>'Create Post', 'url'=>array('create')),
	array('label'=>'Update Post', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Post', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Post', 'url'=>array('admin')),
);
?>
<div id="myslidemenu" class="jqueryslidemenu">
 
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
<h1>View Post #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'tittle',
		'content',
		'tags',
		'status',
		'create_time',
		'update_time',
	),
)); ?>
