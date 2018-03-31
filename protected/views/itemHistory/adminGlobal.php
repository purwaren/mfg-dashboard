<?php
/* @var $this ItemHistoryController */
/* @var $model ItemHistoryGlobal */

$this->breadcrumbs=array(
	'Laporan'=>array('index'),
	'Rekap Global Barang Toko',
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

<h1>Rekap Global Barang Toko</h1>

<p>
Anda bisa menggunakan operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
atau <b>=</b>) pada nilai awal pencarian sebagai parameter pembanding.
</p>

<?php echo CHtml::link('Kriteria Pencarian','#',array('class'=>'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_searchGlobal',array(
	'model'=>$model,
)); ?>

</div><!-- search-form -->

<?php

    if (!empty($itemHist))
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

        //processing row
        $row_data = '';
        $row_store = '';

        $i=0;
        foreach ($data as $row)
        {
            $row_data .= '<tr><td>'.++$i.'</td><td>'.$row['category'].'</td><td>20'.$row['year'].'</td><td style="text-align:right">'.number_format($row['qty']).'</td></tr>';
            $row_store .= '<tr>';
            $all_qty = $model->searchAllItem($row['year']);
            foreach ($store as $key=>$st)
            {
                if (isset($all_qty[$st->code]))
                {
                    if ($key%2 == 0)
                        $row_store .= '<td style="color:#555;background-color:#ddd; text-align: right;">'.$all_qty[$st->code].'</td>';
                    else $row_store .= '<td style="color:#555;background-color:#fff; text-align: right;">'.$all_qty[$st->code].'</td>';
                }
                else
                {
                    if ($key%2 == 0)
                        $row_store .= '<td style="color:#555;background-color:#ddd; text-align: right;"> - </td>';
                    else $row_store .= '<td style="color:#555;background-color:#fff; text-align: right;"> - </td>';

                }
            }
            $row_store .= '</tr>';
        }
    }
?>
<?php if (!empty($itemHist)) { ?>
<div class="grid-view">
    <h4><?php echo $model->getTitle() ?></h4>
	<div class="left">
	<table class="items">
		<thead>
        <tr>
            <th rowspan="2">No</th>
            <th colspan="3">Info Kelompok Barang</th>
        </tr>
		<tr>
			<th>Kelompok Barang</th>
            <th>Tahun</th>
            <th>Qty</th>
		</tr>
        <?php echo $row_data; ?>
		</thead>
        <tr>
            <td colspan="3">T O T A L</td>
            <td><?php echo number_format($model->countAllQ()) ?></td>
        </tr>
	</table>
	</div>
	
	<div class="right">
	<table class="items" style="<?php echo $width ?>">
		<thead>
            <?php echo $header_store ?>
		</thead>
        <?php echo $row_store?>
	</table>	
	</div>
	&nbsp;<br />	
	<div>
	<?php $this->widget('CLinkPager', array(
	    'pages' => $pages,
		'firstPageCssClass'=>'page'
	)) ?>
    </div>
</div>
<?php } ?>
