<?php
/* @var $this ItemHistoryGudangController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Item History Gudangs',
);

$this->menu=array(
	array('label'=>'Create ItemHistoryGudang', 'url'=>array('create')),
	array('label'=>'Manage ItemHistoryGudang', 'url'=>array('admin')),
);
?>

<h1>Item History Gudangs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
