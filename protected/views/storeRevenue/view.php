<?php
/* @var $this StoreRevenueController */
/* @var $model StoreRevenue */

$this->breadcrumbs=array(
	'Store Revenues'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List StoreRevenue', 'url'=>array('index')),
	array('label'=>'Create StoreRevenue', 'url'=>array('create')),
	array('label'=>'Update StoreRevenue', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete StoreRevenue', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StoreRevenue', 'url'=>array('admin')),
);
?>

<h1>View StoreRevenue #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'store_code',
		'date',
		'current_revenue',
		'last_updated',
	),
)); ?>
