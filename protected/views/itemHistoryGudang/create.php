<?php
/* @var $this ItemHistoryGudangController */
/* @var $model ItemHistoryGudang */

$this->breadcrumbs=array(
	'Item History Gudangs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ItemHistoryGudang', 'url'=>array('index')),
	array('label'=>'Manage ItemHistoryGudang', 'url'=>array('admin')),
);
?>

<h1>Create ItemHistoryGudang</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>