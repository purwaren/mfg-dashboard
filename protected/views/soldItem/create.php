<?php
/* @var $this SoldItemController */
/* @var $model SoldItem */

$this->breadcrumbs=array(
	'Sold Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SoldItem', 'url'=>array('index')),
	array('label'=>'Manage SoldItem', 'url'=>array('admin')),
);
?>

<h1>Create SoldItem</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>