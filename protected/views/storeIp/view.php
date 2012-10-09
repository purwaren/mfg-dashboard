<?php
$this->breadcrumbs=array(
	'Store Ips'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List StoreIp', 'url'=>array('index')),
	array('label'=>'Create StoreIp', 'url'=>array('create')),
	array('label'=>'Update StoreIp', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete StoreIp', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StoreIp', 'url'=>array('admin')),
);
?>

<h1>View StoreIp #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'store_code',
		'name',
		'current_ip',
		'last_updated',
	),
)); ?>
