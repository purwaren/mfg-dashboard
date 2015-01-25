<?php
/* @var $this StoreRevenueController */
/* @var $model StoreRevenue */

$this->breadcrumbs=array(
	'Omset Toko'=>array('index'),
	'Daftar',
);

$this->menu=array(
	//array('label'=>'List StoreRevenue', 'url'=>array('index')),
	//array('label'=>'Create StoreRevenue', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.update('omset', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Daftar Omset Koalisi</h1>

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

<div class="grid-view" id="omset" style="padding: 10px;margin: 10px auto; width: 610px; border: 1px solid;">
	<h3 style="text-align: center">DAFTAR OMSET <br />
	PERIODE: <?php echo $model->getDate().$model->getDateTo()?> 
	</h3>
	<?php 
		$label = array(); $data=array(); $total=0; $temp = array();
		foreach($omset as $row)
		{			
			$total += $row['omset'];
		}
		foreach($omset as $row)
		{
			$poin = round(($row['omset']/$total)*100,2);
			$label[] = $row['koalisi'];
			$data[] = $poin;
		}
		
       	$this->widget(
            'chartjs.widgets.ChBars', 
            array(
                'width' => 600,
                'height' => 300,                
                'labels' => $label,				
                'datasets' => array(
                    array(						
                        "fillColor" => "#599fd7",
						"highlightFill" => "#58D3F7",
                        "strokeColor" => "#ffffff",
                        "data" => $data,
                    )       
                ),
                'options' => array(
					'scaleBeginAtZero'=>true,
					'scaleShowHorizontalLines'=>true
				)		
            )
        ); 
    ?>
</div>
