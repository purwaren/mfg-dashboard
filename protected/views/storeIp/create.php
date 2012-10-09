<?php
$this->breadcrumbs=array(
	'Store Ips'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List StoreIp', 'url'=>array('index')),
	array('label'=>'Manage StoreIp', 'url'=>array('admin')),
);
?>

<h1>Create StoreIp</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>