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
	//processing header
	$h1='';$h2='';$t=0;
	foreach($store as $row)
	{		
		$h1 .= '<th colspan="2" style="width:100px;">'.$row->alias.'</th>';
		$h2 .= '<th style="width:50px;">M</th><th style="width:50px;">S</th>';
	}
	$header_store = '<tr>
						'.$h1.'						
						<th rowspan="2">Stok Gudang</th>
						<th rowspan="2">Periode</th>
					</tr>
					<tr>'.$h2.'</tr>';	
	
	
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
					</tr>';
		$dist = ItemDistribution::model()->shop_desc()->findAllByAttributes(array(
			'item_code'=>$row['item_code']
		));
		$tmp = '';
		foreach($store as $shop)
		{
			$itemshop = ItemHistory::model()->findByAttributes(array(
				'item_code'=>$row['item_code'],
				'store_code'=>$shop->code,
			));
			if(!empty($itemshop))
				$tmp .= '<td style="text-align:center">'.$itemshop->qty_in.'</td>
						<td style="text-align:center">'.$itemshop->qty_stock.'</td>';
			else 
				$tmp .= '<td style="text-align:center">-</td>
						<td style="text-align:center">-</td>';
		}		
		$row_dist .= '<tr>
						'.$tmp.'						
						<td style="text-align:center">'.$row['qty_stock'].'</td>
						<td style="text-align:center">'.$row['periode'].'</td></tr>';
	}	
	
?>

<div class="grid-view">
	<p style="text-align:right">Menampilkan <?php echo $summary ?> hasil</p>
	<div class="left">
	<table class="items">
		<thead>
		<tr>
			<th rowspan="2">No</th>
			<th colspan="3">Info Barang</th>
			<th rowspan="2">Supplier</th>
			<th rowspan="2" style="width: 60px;">Qty Masuk Gudang</th>			
		</tr>
		<tr>
			<th>Kode</th>			
			<th>Nama</th>
			<th>Harga</th>
			
		</tr>
		</thead>
		<?php echo $row_data ?>		
	</table>
	</div>
	
	<div class="right">
	<table class="items">
		<thead>
		<?php echo $header_store?>
		</thead>	
		<?php echo $row_dist ?>	
	</table>	
	</div>
	&nbsp;<br />	
	<div>
	<?php $this->widget('CLinkPager', array(
	    'pages' => $pages,
	)) ?></div>
</div>
<?php }?>
