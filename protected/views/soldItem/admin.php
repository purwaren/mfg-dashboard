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

<h1>Daftar Item</h1>

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

<?php 
if(isset($soldItem)) { 

	$count=Store::model()->count();
	if($count <=15 )
		$width='width: 710px;';
	else
	{
		$width = $count*50;
		$width = 'width: '.$width.'px;';
	}
	//processing header
	$h1='';$h2='';$k=0;
	foreach($group as $key=>$g)
	{
		$t=0;
		foreach($g as $row)
		{
			$t++;$k++;
			if($k%2==1)
				$h2 .= '<td style="color:#555;background-color:#ddd;text-align:bold;font-weight:bold;text-align:center;">'.$row['alias'].'</td>';
			else $h2 .= '<td style="color:#555;background-color:#fff;text-align:bold;font-weight:bold;text-align:center;">'.$row['alias'].'</td>';
		}
	
		$h1 .='<th colspan="'.$t.'">'.$key.'</th>';
	}
	
	//processing row data
	$row_data='';
	$i=($page-1)*Yii::app()->params['pagination']['size'];
	$row_store='';
	$total_q=$model->sumAllQ();
	foreach($data as $row)
	{
		$i++;
		$t=0;
		$row_store='';
		foreach($store as $st)
		{
			$t++;
			$dsold=$model->findAllStoreQtySold(array(
				'shop_code'=>$st->code,
				'category'=>$row->category
			));
// 			var_dump($dsold);exit;
			if($t%2==1)
			{
				if(!empty($dsold))
					$row_store .= '<td style="text-align: right;background-color:#ddd">'.number_format($dsold->qty_sold).'</td>';
				else
					$row_store .= '<td style="text-align: center;background-color:#ddd">-</td>';
			}
			else
			{
				if(!empty($dsold))
					$row_store .= '<td style="text-align: right;">'.number_format($dsold->qty_sold).'</td>';
				else
					$row_store .= '<td style="text-align: center">-</td>';
			}
		}
		$row_data .='<tr>
					<td>'.$i.'</td>
					<td>'.$row->category.'</td>
					<td style="text-align: right">'.number_format($row->total).'</td>
					'.$row_store.'
			</tr>';
		
	}
	
	//processing row total
	$t=0;$row_total='';
	foreach ($store as $st)
	{
		$t++;
		$total_shop = $model->summaryAllItemCateogry($st->code);
		if($t%2==1)
		{
			if(!empty($total_shop))
				$row_total .= '<td style="text-align: right;background-color:#ddd">'.number_format($total_shop->total).'</td>';
			else
				$row_total .= '<td style="text-align: center;background-color:#ddd">-</td>';
		}
		else
		{
			if(!empty($total_shop))
				$row_total .= '<td style="text-align: right;">'.number_format($total_shop->total).'</td>';
			else
				$row_total .= '<td style="text-align: center">-</td>';
		}
	}

?>
<h3 style="text-align: center; font-size: 12pt; font-weight:bold">
	Penjualan Item Toko<br />Periode: <?php echo $model->getStartDate().' s.d. '.$model->getEndDate() ?>
</h3>

<div class="grid-view">
	<p style="text-align:right">Menampilkan <?php echo $summary ?> hasil</p>
	<table class="items">
		<thead>
		<tr>
			<th rowspan="2">No</th>
			<th rowspan="2">Kel. Barang</th>
			<th rowspan="2">QTY</th>
			<?php echo $h1?>			
		</tr>
		<tr><?php echo $h2?></tr>		
		</thead>
		<?php echo $row_data ?>
		<tr>
			<td colspan="2">TOTAL</td>
			<td style="text-align: right; font-weight: bold"><?php echo number_format($total_q->total)?></td>
			<?php echo $row_total?>
		</tr>
	</table>
	&nbsp;<br />	
	<div>
	<?php $this->widget('CLinkPager', array(
	    'pages' => $pages,
	)) ?></div>
</div>

<?php } ?>