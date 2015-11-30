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
<div class="page-header">
	<h1>Daftar Omset Toko</h1>
</div>
<p>
Anda bisa menggunakan operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
atau <b>=</b>) pada nilai awal pencarian sebagai parameter pembanding.
</p>

<div class="widget-box collapsed">
	<div class="widget-header">
		<h5>Advance Search</h5>
		<div class="widget-toolbar">			
			<a href="#" data-action="collapse">
				<i class="icon-chevron-down"></i>
			</a>			
		</div>
	</div>
	<div class="widget-body">
		<div class="widget-main">
			<?php $this->renderPartial('_search',array(
				'model'=>$model,
			)); ?>
		</div>
	</div>
</div>

<?php
$this->widget('ext.EExcelView.EExcelView', array(
	'id'=>'store-revenue-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass'=>'table table-striped table-bordered table-hover',
	'template' => "{summary}\n{items}\n{exportbuttons}\n{pager}",
	'exportType' =>'PDF',
	'exportButtons' => array('Excel5','PDF'),
	'title' => 'Mode Fashion Group - Daftar Omset Toko',
	'filename' => 'Omset-'.date('d-m-Y'),
	'grid_mode' => 'grid',
	'columns'=>array(
		array(
			'header'=>'No',
			'value'=>'$row+1'
		),
		'store_code',
		array(
			'header'=>'Nama Toko',
			'value'=>'$data->getStoreName()'
		),
		array(
			'header'=>'Tanggal',
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
