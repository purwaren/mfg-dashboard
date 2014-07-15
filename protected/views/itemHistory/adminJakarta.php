<?php
/* @var $this ItemHistoryController */
/* @var $model ItemHistory */

$this->breadcrumbs=array(
	'Laporan'=>array('index'),
	'Riwayat Barang Jakrta',
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

Yii::app()->clientScript->registerCss('grid',"
	.grid-view {
		padding-top: 15px;		
		min-height: 150px;
		
	}
	.items {
		font-size: 12pt;		
	}
	.left {	
		position: relative;	
		width: 40%;
		//border: 1px solid;	
		display:inline-block;	
		
	}
	.right {
		position: relative;
		display:inline-block;
		text-align:left;		
		width: 60%;	
		overflow: auto;	
	}
		
");
?>

<h1>Riwayat Barang Jakarta</h1>

<p>
Anda bisa menggunakan operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
atau <b>=</b>) pada nilai awal pencarian sebagai parameter pembanding.
</p>

<?php echo CHtml::link('Kriteria Pencarian','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_searchJakarta',array(
	'model'=>$model,
)); ?>

</div><!-- search-form -->

<?php
if(isset($itemHist))
{ 	
	$i = $model->size*($page-1)+1;
	$row_data = '';	$row_dist='';
	foreach($data as $row)
	{
		//processing row barang
		$row_data .= '<tr>
						<td>'.$i++.'</td>
						<td>'.CHtml::link($row['item_code'],Yii::app()->createUrl('itemHistory/viewJakarta',array('id'=>$row['item_code']))).'</td>
						<td style="width: 100px;">'.substr($row['name'],0,13).'</td>
						<td>'.number_format($row['offer_price']).'</td>
						<td>'.ucwords($row['supplier']).'</td>
						<td style="text-align:center">'.$row['qty_in'].'</td>
						<td style="text-align:center">'.(!isset($row['stok_toko'])?'-':$row['stok_toko']).'</td>
						<td style="text-align:center">'.$row['stok_gudang'].'</td>
						<td style="text-align:center">'.$row['periode'].'</td>
					</tr>';
		
	}	
	
?>

<div class="grid-view">
	<p style="text-align:right">Menampilkan <?php echo $summary ?> hasil</p>	
	<table class="items">
		<thead>
		<tr>
			<th rowspan="2">No</th>
			<th colspan="3">Info Barang</th>
			<th rowspan="2">Supplier</th>
			<th rowspan="2" style="width: 60px;">Qty Masuk Gudang</th>	
			<th rowspan="2">Stok Toko</th>
			<th rowspan="2">Stok Gudang</th>
			<th rowspan="2">Periode</th>		
		</tr>
		<tr>
			<th>Kode</th>			
			<th>Nama</th>
			<th>Harga</th>
			
		</tr>
		</thead>
		<?php echo $row_data ?>		
	</table>
		
	&nbsp;<br />	
	<div>
	<?php $this->widget('CLinkPager', array(
	    'pages' => $pages,
	)) ?></div>
</div>
<?php }?>
