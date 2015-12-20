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
	
</div>

<?php } ?>