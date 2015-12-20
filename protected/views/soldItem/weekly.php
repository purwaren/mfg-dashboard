<?php
/* @var $this SoldItemController */
/* @var $model SoldItem */

$this->breadcrumbs=array(
    'Daftar Item',
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

<h1 class="no-print">Rekap Penjualan Per Minggu</h1>

<p class="no-print">
    Anda bisa menggunakan operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    atau <b>=</b>) pada nilai awal pencarian sebagai parameter pembanding.
</p>

<?php echo CHtml::link('Kriteria Pencarian','#',array('class'=>'search-button no-print')); ?>
<div class="search-form no-print" style="display:none">
    <?php $this->renderPartial('_searchWeekly',array(
        'model'=>$model,
    )); ?>

</div><!-- search-form -->
<?php if(!empty($report)) {
    //create header
    $header = '<tr>';
    foreach($period as $row) {
        $header .= '<th>'.$row.'</th>';
    }
    $header .= '</tr>';

    //populate row data
    $row_data = '';$total = array();$all_total=0;
    $i = ($model->current_page-1)*$model->page_size;
    foreach ($report as $row) {
        $tmp = '';$tmp_total=0;

        foreach($period as $tgl) {
            $tmp .= '<td>'.$row['data'][$tgl].'</td>';
            if(!isset($total[$tgl]))
                $total[$tgl] = 0;
            $total[$tgl] += $row['data'][$tgl];
            $tmp_total += $row['data'][$tgl];
        }
        $row_data .= '<tr>
                <td>'.++$i.'</td>
                <td>'.$row['cat_code'].'</td>
                <td>'.$row['cat_name'].'</td>
                '.$tmp.'
                <td>'.$tmp_total.'</td>
        </tr>';
        $all_total += $tmp_total;
    }

    //populate row total
    $row_total = '';
    foreach($period as $tgl) {
        $row_total .= '<td>'.$total[$tgl].'</td>';
    }
    $row_total .= '<td>'.$all_total.'</td>';



    ?>
<h3 style="text-align: center; font-size: 12pt; font-weight:bold">
    Laporan Item Terjual Perminggu<br />
    Periode: <?php echo $model->getStartDate().' s.d. '.$model->getEndDate() ?>
</h3>

<div class="form grid-view">
    <p style="text-align:right" class="no-print">Menampilkan <?php echo $model->getSummaryText() ?></p>
    <table class="items">
        <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Kelompok</th>
            <th rowspan="2">Nama</th>
            <th colspan="7">Qty Terjual/Tanggal</th>
            <th rowspan="2">Total</th>
        </tr>
        <?php echo $header;?>
        </thead>
        <?php echo $row_data ?>
        <tr>
            <td colspan="3">TOTAL</td>
            <?php echo $row_total ?>
        </tr>
    </table>
    &nbsp;<br />
    <div>
        <?php echo 'Halaman: ';$this->widget('CLinkPager', array(
            'pages' => $pages,
        )) ?>
    </div>
</div>
<div class="row buttons" style="text-align:right">
    <?php echo CHtml::linkButton('Cetak',array(
        'href'=>Yii::app()->createUrl('soldItem/weekly',array('print'=>'yes')),
        'target'=>'_new'));
    ?>
</div>
<?php } ?>