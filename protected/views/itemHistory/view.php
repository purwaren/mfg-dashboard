<?php
/* @var $this ItemHistoryController */
/* @var $model ItemHistory */

$this->breadcrumbs=array(
	'Laporan Riwayat Barang'=>array(),
	$model->item_code,
);

$this->menu=array(
	//array('label'=>'List ItemHistory', 'url'=>array('index')),
	//array('label'=>'Create ItemHistory', 'url'=>array('create')),
	//array('label'=>'Update ItemHistory', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete ItemHistory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Laporan Riwayat Barang', 'url'=>array('admin')),
);
?>

<h1>Detil Barang: <?php echo $model->item_code; ?></h1>
<div class="form grid-view">
<fieldset><legend>Informasi Umum</legend>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(		
		'item_code',
		'name',
		array(
			'label'=>'Harga',
			'value'=>number_format($model->price)
		),
		array(
			'label'=>'Tanggal Masuk',
			'value'=>$model->getTanggalMasuk()
		),		
	),
)); ?>
</fieldset>
<fieldset>
	<legend>Distribusi Barang</legend>
	<table class="items">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Toko</th>
				<th>Masuk</th>
				<th>Jual</th>
				<th>Stok</th>
			</tr>
		</thead>
		<?php 
		$i=0;$m=0;$j=0;$s=0;
		$tmp='';
		foreach($models as $row){
			$tmp .= '<tr>
						<td style="text-align:right">'.++$i.'</td>
						<td>'.$row->store->name.'</td>
						<td style="text-align:right">'.$row->qty_in.'</td>
						<td style="text-align:right">'.$row->qty_sold.'</td>
						<td style="text-align:right">'.$row->qty_stock.'</td>
					</tr>';
			$m += $row->qty_in;
			$j += $row->qty_sold;
			$s += $row->qty_stock;
		}
		echo $tmp;
		echo '<tr>
				<td colspan="2"> <b>T O T A L </b></td>
				<td style="text-align:right"><b>'.$m.'</b></td>
				<td style="text-align:right"><b>'.$j.'</b></td>
				<td style="text-align:right"><b>'.$s.'</b></td>
			</tr>';
		?>
	</table>
</fieldset>
<div class="row buttons">
		<?php echo CHtml::linkButton('Kembali',array('href'=>Yii::app()->user->returnUrl)); ?>
	</div>
</div>