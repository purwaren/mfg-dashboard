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

<h1>Rekap Penjualan Per Minggu</h1>

<p>
    Anda bisa menggunakan operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    atau <b>=</b>) pada nilai awal pencarian sebagai parameter pembanding.
</p>

<?php echo CHtml::link('Kriteria Pencarian','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_searchWeekly',array(
        'model'=>$model,
    )); ?>

</div><!-- search-form -->
<?php if(!empty($report)) { ?>
<h3 style="text-align: center; font-size: 12pt; font-weight:bold">
    Laporan Item Terjual Perminggu<br />
    Periode: <?php echo $model->getStartDate().' s.d. '.$model->getEndDate() ?>
</h3>

<div class="form grid-view">
    <p style="text-align:right">Menampilkan <?php //echo $summary ?> hasil</p>
    <table class="items">
        <thead>
        <tr>
            <th>No</th>
            <th>Kelompok</th>
            <th>Nama</th>
            <th>Qty Terjual/Tanggal</th>
            <th>Total</th>
        </tr>
        </thead>
        <?php //echo $row_data ?>
<!--        <tr>-->
<!--            <td colspan="3">TOTAL</td>-->
<!--            <td style="text-align: right; font-weight: bold"></td>-->
<!--            <td style="text-align: right; font-weight: bold"></td>-->
<!--            <td style="text-align: right; font-weight: bold"></td>-->
<!--        </tr>-->
    </table>
    &nbsp;<br />
    <div>
        <?php echo 'Halaman: ';$this->widget('CLinkPager', array(
            'pages' => $pages,
        )) ?>
    </div>
</div>
<?php } ?>