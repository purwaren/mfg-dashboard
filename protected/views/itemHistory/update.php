<?php
/* @var $this ItemHistoryController */
/* @var $model ItemHistory */

$this->breadcrumbs=array(
	'Item Histories'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ItemHistory', 'url'=>array('index')),
	array('label'=>'Create ItemHistory', 'url'=>array('create')),
	array('label'=>'View ItemHistory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ItemHistory', 'url'=>array('admin')),
);
?>

<h1>Update ItemHistory <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>