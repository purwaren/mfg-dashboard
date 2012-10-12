<?php
/* @var $this StoreRevenueController */
/* @var $model StoreRevenue */

$this->breadcrumbs=array(
	'Store Revenues'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List StoreRevenue', 'url'=>array('index')),
	//array('label'=>'Create StoreRevenue', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('store-revenue-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Daftar Omset Toko</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'store-revenue-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'No',
			'value'=>'$this->grid->dataProvider->pagination->pageSize*$this->grid->dataProvider->pagination->currentPage+$row+1'
		),
		'store_code',
		array(
			'header'=>'Name',
			'value'=>'$data->getStoreName()'
		),
		array(
			'name'=>'date',
			'value'=>'$data->getDate()'
		),
		array(
			'name'=>'current_revenue',
			'value'=>'number_format($data->current_revenue)',
			'htmlOptions'=>array('style'=>'text-align:right;font-weight:bold'),
		),
		array(
			'name'=>'last_updated',
			'value'=>'date("F d, Y H:i:s",$data->last_updated)'
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}'
		),
	),
)); ?>
