<?php
/* @var $this ItemHistoryController */
/* @var $model ItemHistory */

$this->breadcrumbs=array(
	'Laporan'=>array('index'),
	'Rekap Penjualan',
);

$this->menu=array(
	array('label'=>'List ItemHistory', 'url'=>array('index')),
	array('label'=>'Create ItemHistory', 'url'=>array('create')),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('item-history-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<h1>Rekap Penjualan</h1>

<p>
Anda bisa menggunakan operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
atau <b>=</b>) pada nilai awal pencarian sebagai parameter pembanding.
</p>

<?php echo CHtml::link('Kriteria Pencarian','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_searchJakartaSales',array(
	'model'=>$model,
)); ?>

</div><!-- search-form -->

<?php
if(isset($itemHist))
{ 
	$row_data='';$i=0;
	foreach($data as $row)
	{
		$row_data .= '<tr>
			<td>'.++$i.'</td>
			<td>'.$row['kelompok'].'</td>
			<td>'.$row['total_in'].'</td>
			<td>'.$row['total_sold'].'</td>
			<td>'.$row['total_stock'].'</td>
		</tr>';
	}
?>

<div class="grid-view">
	<p style="text-align:right">Menampilkan <?php echo $summary ?> hasil</p>
	
	<table class="items">
		<thead>
		<tr>
			<th>No</th>
			<th>Kelompok Barang</th>	
			<th>Masuk</th>
			<th>Terjual</th>
			<th>Stok</th>		
		</tr>		
		</thead>
		<?php echo empty($row_data)?'<tr><td colspan="4"><i>Tidak ada hasil</i></td></tr>':$row_data?>		
	</table>
	
	<?php 
 		$this->widget('CLinkPager', array(
 	    	'pages' => $pages,
 		)) 
	?>
</div>
<?php }?>
