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
	.items {
		font-size: 12pt;		
	}
	.left {	
		position: relative;	
		width: 25%;
		//border: 1px solid;	
		display:inline-block;	
		
	}
	.right {
		position: relative;
		display:inline-block;
		text-align:left;		
		width: 75%;	
		overflow: auto;	
	}
		
");
?>

<h1>Riwayat Barang</h1>

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
if(isset($itemHist))
{ 
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
	$header_store = '<tr>'.$h1.'</tr><tr>'.$h2.'</tr>';
	
	//processing row data
	$row_data='';
	$i=($page-1)*Yii::app()->params['pagination']['size'];
	$row_store='';
	$total_q=$model->countAllQ();
	foreach($data as $row)
	{
		$i++;
		$tmp = explode('-', $row->date_in);
		$date_in = $tmp[2].'/'.$tmp[1].'/'.$tmp[0];
		$row_data .= '<tr>
						<td>'.$i.'</td>
						<td>'.CHtml::link($row->item_code,Yii::app()->createUrl('itemHistory/view',array('id'=>$row->item_code))).'</td>						
						<td style="text-align:right">'.number_format($row->price).'</td>
						<td style="text-align:center">'.$row->total.'</td>
					</tr>';
		
		$row_store .= '<tr>';
		$t=0;
		foreach($store as $st)
		{
			$t++;
			$dhist = ItemHistory::model()->hist()->findByAttributes(array(
				'item_code'=>$row->item_code,
				'store_code'=>$st->code
			));
			if($t%2==1)
			{
				if(!empty($dhist))
					$row_store .= '<td style="text-align:center;background-color:#ddd">'.$dhist->qty_stock.'</td>';
				else 
					$row_store .= '<td style="text-align:center;background-color:#ddd">-</td>';
			}
			else
			{
				if(!empty($dhist))
					$row_store .= '<td style="text-align:center;">'.$dhist->qty_stock.'</td>';
				else
					$row_store .= '<td style="text-align:center">-</td>';
			}
		}
		$row_store .= '</tr>';
	}
	$row_total='';
	$t=0;
	foreach($store as $row)
	{
		$t++;
		if($t%2==1)
		{
			if(isset($total[$row->code]))
				$row_total .= '<td  style="text-align:center;background-color:#ddd"><b>&nbsp;</b></td>';
			else 
				$row_total .= '<td style="text-align:center;background-color:#ddd"><b>&nbsp;</b></td>';
		}
		else 
		{
			if(isset($total[$row->code]))
				$row_total .= '<td  style="text-align:center"><b>&nbsp;</b></td>';
			else
				$row_total .= '<td style="text-align:center"><b>&nbsp;</b></td>';
		}
	}
	$row_total = '<tr>'.$row_total.'</tr>';
	//exit;
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
			<th>Harga</th>
			<th>Q</th>
		</tr>
		</thead>
		<?php echo empty($row_data)?'<tr><td colspan="4"><i>Tidak ada hasil</i></td></tr>':$row_data?>
		<tr><td colspan="3"><b>T O T A L</b></td>
		<td style="text-align: center"><b><?php echo $total_q->total?></b></td></tr>
	</table>
	</div>
	
	<div class="right">
	<table class="items" style="<?php echo $width?>">
		<thead>
		<?php echo $header_store?>
		</thead>
		<?php echo $row_store?>
		<?php echo $row_total?>
	</table>	
	</div>
	&nbsp;<br />	
	<div>
	<?php $this->widget('CLinkPager', array(
	    'pages' => $pages,
	)) ?></div>
</div>
<?php }?>
