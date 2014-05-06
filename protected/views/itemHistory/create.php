<?php
/* @var $this ItemHistoryController */
/* @var $model ItemHistory */

$this->breadcrumbs=array(
	'Item Histories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ItemHistory', 'url'=>array('index')),
	array('label'=>'Manage ItemHistory', 'url'=>array('admin')),
);
?>

<h1>Create ItemHistory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>