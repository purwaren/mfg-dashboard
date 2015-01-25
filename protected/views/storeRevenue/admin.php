<?php
/* @var $this StoreRevenueController */
/* @var $model StoreRevenue */

$this->breadcrumbs=array(
	'Omset Toko'=>array('index'),
	'Daftar',
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
Anda bisa menggunakan operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
atau <b>=</b>) pada nilai awal pencarian sebagai parameter pembanding.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
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
			'header'=>'Nama Toko',
			'value'=>'$data->getStoreName()'
		),
		array(
			'name'=>'date',
			'value'=>'$data->getDate()',
			'footer'=>'TOTAL'
		),
		array(
			'visible'=>Yii::app()->user->checkAccess('owner'),
			'name'=>'current_revenue',
			'value'=>'number_format($data->current_revenue)',
			'htmlOptions'=>array('style'=>'text-align:right;font-weight:bold'),
			'footer'=>number_format($model->getTotalRevenue()),
			'footerHtmlOptions'=>array('style'=>'text-align:right;font-style:normal;font-weight:bold'),
		),
		array(
			'name'=>'point',			
			'footer'=>'100',
			'htmlOptions'=>array('style'=>'text-align:right;font-weight:bold'),
			'footerHtmlOptions'=>array('style'=>'text-align:right;font-style:normal;font-weight:bold'),
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
