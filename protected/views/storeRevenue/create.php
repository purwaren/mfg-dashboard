<?php
/* @var $this StoreRevenueController */
/* @var $model StoreRevenue */

$this->breadcrumbs=array(
	'Store Revenues'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List StoreRevenue', 'url'=>array('index')),
	array('label'=>'Manage StoreRevenue', 'url'=>array('admin')),
);
?>

<h1>Create StoreRevenue</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>