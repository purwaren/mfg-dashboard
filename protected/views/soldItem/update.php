<?php
/* @var $this SoldItemController */
/* @var $model SoldItem */

$this->breadcrumbs=array(
	'Sold Items'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SoldItem', 'url'=>array('index')),
	array('label'=>'Create SoldItem', 'url'=>array('create')),
	array('label'=>'View SoldItem', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SoldItem', 'url'=>array('admin')),
);
?>

<h1>Update SoldItem <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>