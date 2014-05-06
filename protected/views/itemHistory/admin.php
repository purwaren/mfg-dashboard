<?php
/* @var $this ItemHistoryController */
/* @var $model ItemHistory */

$this->breadcrumbs=array(
	'Laporan'=>array('index'),
	'Riwayat Barang',
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
	.left {	
		position: relative;	
		width: 50%;
		//border: 1px solid;	
		display:inline-block;	
		
	}
	.right {
		position: relative;
		display:inline-block;
		text-align:left;		
		width: 50%;	
		overflow: auto;	
	}
		
");
?>

<h1>Riwayat Barang</h1>

<p>
Anda bisa menggunakan operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
atau <b>=</b>) pada nilai awal pencarian sebagai parameter pembanding.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>

</div><!-- search-form -->

<?php 
	//processing header
	$h1='';$h2='';
	foreach($store as $row)
	{
		$h1 .= '<th colspan="4">'.$row->name.'</th>';
		$h2 .= '<th style="width: 30px;">M</th>
				<th style="width: 30px;">J</th>
				<th style="width: 30px;">S</th>
				<th style="width: 30px;">P</th>';
	}
	$header_store = '<tr>'.$h1.'</tr><tr>'.$h2.'</tr>';
	
	//processing row data
	$row_data='';
	$i=($page-1)*Yii::app()->params['pagination']['size'];
	$row_store='';
	foreach($data as $row)
	{
		$i++;
		$tmp = explode('-', $row->date_in);
		$date_in = $tmp[2].'/'.$tmp[1].'/'.$tmp[0];
		$row_data .= '<tr>
						<td>'.$i.'</td>
						<td>'.$row->item_code.'</td>
						<td>'.$row->name.'</td>
						<td style="text-align:right">'.number_format($row->price).'</td>
						<td style="text-align:center">'.$date_in.'</td>
					</tr>';
		
		$row_store .= '<tr>';
		foreach($store as $st)
		{
			$dhist = ItemHistory::model()->hist()->findByAttributes(array(
				'item_code'=>$row->item_code,
				'store_code'=>$st->code
			));
			if(!empty($dhist))
				$row_store .= '<td style="text-align:center">'.$dhist->qty_in.'</td>
					<td style="text-align:center">'.$dhist->qty_sold.'</td>
					<td style="text-align:center">'.$dhist->qty_stock.'</td>
					<td style="text-align:center">'.$dhist->period.'</td>';
			else 
				$row_store .= '<td colspan="4"><i>Data tidak tersedia</i></td>';
		}
		$row_store .= '</tr>';
	}
?>

<div class="grid-view">
	<p style="text-align:right">Menampilkan <?php echo $summary ?> hasil</p>
	<div class="left">
	<table class="items">
		<thead>
		<tr>
			<th rowspan="2">No</th>
			<th colspan="4">Info Barang</th>			
		</tr>
		<tr>
			<th>Kode</th>
			<th>Nama</th>
			<th>Harga</th>
			<th>Tgl Masuk</th>
		</tr>
		</thead>
		<?php echo empty($row_data)?'<tr><td colspan="4"><i>Tidak ada hasil</i></td></tr>':$row_data?>
	</table>
	</div>
	
	<div class="right">
	<table class="items">
		<thead>
		<?php echo $header_store?>
		</thead>
		<?php echo $row_store?>
	</table>
	</div>	
	<?php $this->widget('CLinkPager', array(
	    'pages' => $pages,
	)) ?>
</div>

