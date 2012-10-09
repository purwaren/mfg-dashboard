<?php
$this->breadcrumbs=array(
	'Store Ips'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List StoreIp', 'url'=>array('index')),
	array('label'=>'Create StoreIp', 'url'=>array('create')),
	array('label'=>'View StoreIp', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage StoreIp', 'url'=>array('admin')),
);
?>

<h1>Update StoreIp <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>