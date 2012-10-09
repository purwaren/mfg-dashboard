<?php
$this->breadcrumbs=array(
	'Store Ips',
);

$this->menu=array(
	array('label'=>'Create StoreIp', 'url'=>array('create')),
	array('label'=>'Manage StoreIp', 'url'=>array('admin')),
);
?>

<h1>Store Ips</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
