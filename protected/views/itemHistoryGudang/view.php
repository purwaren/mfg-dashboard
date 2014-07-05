<?php
/* @var $this ItemHistoryGudangController */
/* @var $model ItemHistoryGudang */

$this->breadcrumbs=array(
	'Riwayat Barang Gudang'=>array(),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ItemHistoryGudang', 'url'=>array('index')),
	array('label'=>'Create ItemHistoryGudang', 'url'=>array('create')),
	array('label'=>'Update ItemHistoryGudang', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ItemHistoryGudang', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ItemHistoryGudang', 'url'=>array('admin')),
);
?>

<h1>Detil Riwayat Barang</h1>
<div class="grid-view form">
<fieldset><legend>Info Barang</legend>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(		
		'item_code',
		'name',
		'supplier',
		array('label'=>'Harga Modal','value'=>'Rp. '.number_format($model->capital_price)),
		array('label'=>'Harga Jual','value'=>'Rp. '.number_format($model->offer_price)),
		'date_in',
		'date_bon',
		'date_out',		
	),
)); ?>
</fieldset>
<fieldset><legend>Distribusi Barang</legend>
<table class="items">
	<thead>
		<tr>
			<th style="text-align:center">No</th>
			<th style="text-align:center">Nama Toko</th>
			<th style="text-align:center">Distribusi</th>
		</tr>
	</thead>
		<tr>
			<td style="text-align:center">1</td>
			<td>Stok Gudang</td>
			<td style="text-align:center"><?php echo $model->qty_stock?></td>
		</tr>
		<?php 
			$tmp = '';$i=1;$total=$moel->qty_stock;
			foreach ($dist as $row)
			{
				$temp = Store::model()->findByAttributes(array('code'=>$row->shop_code));
				$tmp .= '<tr>
					<td style="text-align:center">'.++$i.'</td>
					<td>'.(isset($temp)?$temp->name:$row->shop_code.' (Unknown)').'</td>
					<td style="text-align:center">'.$row->qty_total.'</td>
				</tr>';
				$total += $row->qty_total;
			}
			echo $tmp;
			echo '<tr>
				<td colspan="2" style="text-align:right">TOTAL</td>
				<td style="text-align:center">'.$total.'</td>
			</tr>';
		?>
	
</table>
</fieldset>
<div class="row buttons">
		<?php echo CHtml::linkButton('Kembali',array('href'=>Yii::app()->user->returnUrl)); ?>
	</div>
</div>
