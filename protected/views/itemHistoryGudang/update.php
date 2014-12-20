<?php
/* @var $this ItemHistoryGudangController */
/* @var $model ItemHistoryGudang */

$this->breadcrumbs=array(
	'Item History Gudangs'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ItemHistoryGudang', 'url'=>array('index')),
	array('label'=>'Create ItemHistoryGudang', 'url'=>array('create')),
	array('label'=>'View ItemHistoryGudang', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ItemHistoryGudang', 'url'=>array('admin')),
);
?>

<h1>Update ItemHistoryGudang <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>