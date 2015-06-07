<?php
/* @var $this StoreItemHistoryController */

$this->breadcrumbs=array(
	'Toko'=>array(),
	'Rekap Stok Per Kelompok',
);

Yii::app()->clientScript->registerScript('search', "
	$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
	});
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('store-grid', {
			data: $(this).serialize()
		});
		return false;
	});
");

?>
<h1>Rekap Stok Barang</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php if(isset($storeItem)) { 

}?>