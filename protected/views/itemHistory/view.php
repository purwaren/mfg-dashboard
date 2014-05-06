<?php
/* @var $this ItemHistoryController */
/* @var $model ItemHistory */

$this->breadcrumbs=array(
	'Item Histories'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ItemHistory', 'url'=>array('index')),
	array('label'=>'Create ItemHistory', 'url'=>array('create')),
	array('label'=>'Update ItemHistory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ItemHistory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ItemHistory', 'url'=>array('admin')),
);
?>

<h1>View ItemHistory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'item_code',
		'name',
		'price',
		'date_in',
		'qty_in',
		'qty_sold',
		'qty_stock',
		'period',
		'store_code',
	),
)); ?>
