<?php
/* @var $this StoreRevenueController */
/* @var $model StoreRevenue */

$this->breadcrumbs=array(
	'Store Revenues'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List StoreRevenue', 'url'=>array('index')),
	array('label'=>'Create StoreRevenue', 'url'=>array('create')),
	array('label'=>'View StoreRevenue', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage StoreRevenue', 'url'=>array('admin')),
);
?>

<h1>Update StoreRevenue <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>