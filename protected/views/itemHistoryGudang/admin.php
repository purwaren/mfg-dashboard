<?php
/* @var $this ItemHistoryGudangController */
/* @var $model ItemHistoryGudang */

$this->breadcrumbs=array(
	'Item History Gudangs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ItemHistoryGudang', 'url'=>array('index')),
	array('label'=>'Create ItemHistoryGudang', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('item-history-gudang-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Riwayat Barang Gudang</h1>

<p>
Anda bisa menggunakan operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
atau <b>=</b>) pada nilai awal pencarian sebagai parameter pembanding.
</p>


<?php echo CHtml::link('Kriteria Pencarian','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php if(isset($itemHist)) { ?>
<div class="grid-view">
	<br />
	<p style="text-align:right">Menampilkan : <?php echo $summary?> hasil</p> 
	<table class="items">
		<thead>
			<tr>
				<th rowspan="2">No</th>
				<th rowspan="2">Kode Barang</th>
				<th rowspan="2">Nama</th>
				<th rowspan="2">Supplier</th>
				<?php if(!Yii::app()->user->checkAccess('gudang')) {?>
				<th rowspan="2">Harga Modal</th>
				<?php } ?>
				<th rowspan="2">Harga Jual</th>
				<th colspan="3">Qty</th>
			</tr>
			<tr>
				<th>M</th>
				<th>S</th>
				<th>T</th>
			</tr>
		</thead>
		<?php			
			$tmp='';
			$i=($page-1)*Yii::app()->params['pagination']['size'];
			foreach ($data as $row)
			{
				if(Yii::app()->user->checkAccess('gudang'))
					$tmp .= '<tr>
						<td style="text-align:center">'.++$i.'</td>
						<td>'.CHtml::link($row->item_code,Yii::app()->createUrl('itemHistoryGudang/view',array('kode'=>$row->item_code))).'</td>
						<td>'.$row->name.'</td>
						<td>'.CHtml::link($row->supplier,Yii::app()->createUrl('supplier/view',array('kode'=>$row->supplier))).'</td>
						
						<td style="text-align:right">'.(is_numeric($row->offer_price)?number_format(trim($row->offer_price)):$row->offer_price).'</td>
						<td>'.$row->qty_in.'</td>
						<td>'.$row->qty_stock.'</td>
						<td>'.$row->qty_dist.'</td>
					</tr>';
				else 
					$tmp .= '<tr>
						<td style="text-align:center">'.++$i.'</td>
						<td>'.CHtml::link($row->item_code,Yii::app()->createUrl('itemHistoryGudang/view',array('kode'=>$row->item_code))).'</td>
						<td>'.$row->name.'</td>
						<td>'.CHtml::link($row->supplier,Yii::app()->createUrl('supplier/view',array('kode'=>$row->supplier))).'</td>
						<td style="text-align:right">'.number_format($row->capital_price).'</td>
						<td style="text-align:right">'.(is_numeric($row->offer_price)?number_format(trim($row->offer_price)):$row->offer_price).'</td>
						<td>'.$row->qty_in.'</td>
						<td>'.$row->qty_stock.'</td>
						<td>'.$row->qty_dist.'</td>
					</tr>';
			} 
			echo $tmp;
		?>
	</table>
	<?php $this->widget('CLinkPager', array(
	    'pages' => $pages,		
	)) ?>
</div>
<?php } ?>

