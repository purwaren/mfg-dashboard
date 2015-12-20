<?php
/* @var $this SoldItemController */
/* @var $model SoldItem */

$this->breadcrumbs=array(	
	'Daftar Item',
);

$this->menu=array(
	array('label'=>'List SoldItem', 'url'=>array('index')),
	array('label'=>'Create SoldItem', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#sold-item-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Rekap Penjualan Per Toko</h1>

<p>
Anda bisa menggunakan operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
atau <b>=</b>) pada nilai awal pencarian sebagai parameter pembanding.
</p>

<?php echo CHtml::link('Kriteria Pencarian','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_searchRekap',array(
	'model'=>$model,
)); ?>

</div><!-- search-form -->

<?php 
if(isset($soldItem)) {	//processing row data
	$row_data='';
	$i=($page-1)*Yii::app()->params['pagination']['size'];
	$row_store='';	
	foreach($data as $row)
	{
		$i++;
		$t=0;	
//  		var_dump($data[0]);exit;
		$row_data .='<tr>
					<td>'.$i.'</td>
					<td>'.$row->category.'</td>
					<td>'.$row->cat_name.'</td>
					<td style="text-align: right">'.number_format($row->qty_in).'</td>
					<td style="text-align: right">'.number_format($row->qty_sold).'</td>
					<td style="text-align: right">'.number_format($row->qty_stock).'</td>
			</tr>';
		
	}
	
	

?>
<h3 style="text-align: center; font-size: 12pt; font-weight:bold">
	Rekap Penjualan Toko: <?php echo $model->getShopName() ?><br />Periode: <?php echo $model->getStartDate().' s.d. '.$model->getEndDate() ?>
</h3>

<div class="form grid-view">
	<p style="text-align:right">Menampilkan <?php echo $summary ?> hasil</p>
	<table class="items">
		<thead>
		<tr>
			<th>No</th>
			<th>Kelompok</th>
			<th>Nama</th>
			<th>Qty Masuk</th>
			<th>Qty Jual</th>
			<th>Stok</th>		
		</tr>		
		</thead>
		<?php echo $row_data ?>
		<tr>
			<td colspan="3">TOTAL</td>
			<td style="text-align: right; font-weight: bold"></td>
			<td style="text-align: right; font-weight: bold"></td>
			<td style="text-align: right; font-weight: bold"></td>
		</tr>
	</table>
	&nbsp;<br />	
	<div>
	<?php $this->widget('CLinkPager', array(
	    'pages' => $pages,
	)) ?></div>
</div>
<div class="row buttons" style="text-align:right">
	<?php echo CHtml::linkButton('cetak',array('href'=>Yii::app()->createUrl('soldItem/rekap',array('print'=>'yes'))))?>
</div>
<?php } ?>