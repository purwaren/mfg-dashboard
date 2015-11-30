<?php
/* @var $this StoreRevenueController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Store Revenues',
);

$this->menu=array(
	array('label'=>'Create StoreRevenue', 'url'=>array('create')),
	array('label'=>'Manage StoreRevenue', 'url'=>array('admin')),
);
?>

<h1>Store Revenues</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
