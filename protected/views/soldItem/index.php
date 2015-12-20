<?php
/* @var $this SoldItemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sold Items',
);

$this->menu=array(
	array('label'=>'Create SoldItem', 'url'=>array('create')),
	array('label'=>'Manage SoldItem', 'url'=>array('admin')),
);
?>

<h1>Sold Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
