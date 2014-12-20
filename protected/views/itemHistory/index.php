<?php
/* @var $this ItemHistoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Item Histories',
);

$this->menu=array(
	array('label'=>'Create ItemHistory', 'url'=>array('create')),
	array('label'=>'Manage ItemHistory', 'url'=>array('admin')),
);
?>

<h1>Item Histories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
