<?php
/* @var $this SoldItemController */
/* @var $model SoldItem */

$this->breadcrumbs=array(
	'Sold Items'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SoldItem', 'url'=>array('index')),
	array('label'=>'Create SoldItem', 'url'=>array('create')),
	array('label'=>'Update SoldItem', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SoldItem', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SoldItem', 'url'=>array('admin')),
);
?>

<h1>View SoldItem #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category',
		'trx_date',
		'qty_in',
		'qty_sold',
		'shop_code',
	),
)); ?>
