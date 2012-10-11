<?php
$this->breadcrumbs=array(
	'Daftar IP Sikasir'=>array('admin'),
	
);

//$this->menu=array(
//	array('label'=>'List StoreIp', 'url'=>array('index')),
//	array('label'=>'Create StoreIp', 'url'=>array('create')),
//);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('store-ip-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Daftar IP Sikasir</h1>

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
	'id'=>'store-ip-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'id',
		'store_code',
		'name',
		'current_ip',
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
