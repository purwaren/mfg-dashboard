<?php
/* @var $this StoreRevenueController */
/* @var $model StoreRevenue */

$this->breadcrumbs=array(
	'Beranda'=>array(),	
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('omset', {
		data: $(this).serialize()
	});
	return false;
});
");
Yii::app()->clientScript->registerCss('beranda',"
	.beranda div{
		float: left;
		margin: 10px;		
	}
	.beranda div.left {
		width: 25%;
	}
	.beranda div.right {
		width: 70%;
	}
	.beranda div.news {
		width: 98%;
	}
");

$news = Comment::model()->orderByIdDesc()->findAll();

?>
<div class="row">
	<div class="col-sm-4">
		<div class="widget-box">
			<div class="widget-header header-color-red2">
				<h4 class="smaller">
					<i class="icon-bar-chart smaller-80"></i>
					Grafik Penjualan: <?php echo $model->getDate()?> 
				</h4>			
			</div>
			<div class="widget-body">
				<div class="widget-main">					
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
				                'width' => 300,
				                'height' => 400,  				            
				                'labels' => $label,				
				                'datasets' => array(
				                    array(						
				                        "fillColor" => "#599fd7",
										"highlightFill" => "#68BC31",
				                        "strokeColor" => "#ffffff",
				                        "data" => $data,
				                    )       
				                ),
				                'options' => array(
									'scaleBeginAtZero'=>true,
									'scaleShowHorizontalLines'=>true,
									'scaleFontSize'=>16
								)		
				            )
				        ); 
				    ?> 
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="widget-box">
			<div class="widget-header header-color-blue">
				<h4 class="smaller">
					<i class="icon-shopping-cart smaller-80"></i>
					Daftar Omset: <?php echo $model->getDate()?> 
				</h4>			
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<?php
						$this->widget('zii.widgets.grid.CGridView', array(
							'id'=>'store-revenue-grid',
							'dataProvider'=>$model->search(),
							'itemsCssClass'=>'table table-striped table-bordered table-hover',
							'columns'=>array(
								array(
									'header'=>'No',
									'value'=>'$this->grid->dataProvider->pagination->pageSize*$this->grid->dataProvider->pagination->currentPage+$row+1'
								),
								'store_code',
								array(
									'header'=>'Nama Toko',
									'value'=>'$data->getStoreName()',
									'footer'=>'TOTAL'
								),
								
								array(
									'visible'=>(Yii::app()->user->checkAccess('owner')||Yii::app()->user->checkAccess('manajer1')||Yii::app()->user->checkAccess('manajer2')),
									'name'=>'current_revenue',
									'value'=>'number_format($data->current_revenue)',
									'htmlOptions'=>array('style'=>'text-align:right;font-weight:bold'),
									'footer'=>number_format($model->getTotalRevenue()),
									'footerHtmlOptions'=>array('style'=>'text-align:right;font-style:normal;font-weight:bold'),
								),
								array(
									'name'=>'point',			
									'footer'=>'100',
									'htmlOptions'=>array('style'=>'text-align:right;font-weight:bold'),
									'footerHtmlOptions'=>array('style'=>'text-align:right;font-style:normal;font-weight:bold'),
								),
								array(
									'name'=>'last_updated',
									'value'=>'date("F d, Y H:i:s",$data->last_updated)'
								),
								array(
									'class'=>'CButtonColumn',
									'template'=>'{view}'
								),
							),
						)); ?>	
						<div class="row">
						<?php echo CHtml::link(
							'Lihat detil<i class="icon-arrow-right icon-on-right"></i>', 
							array('storeRevenue/admin'),
							array(
								'class'=>'btn btn-xs btn-success pull-right'
						))?>						
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
<hr />
<div class="row">
	<div class="widget-box">
		<div class="widget-header widget-header-flat">
			<h4 class="smaller">
				<i class="icon-quote-left smaller-80"></i>
				Berita Terkini
			</h4>
		</div>

		<div class="widget-body">
			<div class="widget-main">
				<?php foreach($news as $key=>$row){
					if($key%2 == 0)						
					echo '<div class="row">
							<div class="col-xs-12">
								<blockquote class="pull-right">
									<p>'.$row->content.'</p>		
									<small>
										'.$row->creator->username.'
										<cite title="Source Title">'.date('d/M/Y H:i:s',$row->timestamp).'</cite>
									</small>
								</blockquote>
							</div>
						</div>';
					else 
						echo '<div class="row">
							<div class="col-xs-12">
								<blockquote>
									<p>'.$row->content.'</p>						
									<small>
										'.$row->creator->username.'
										<cite title="Source Title">'.date('d/M/Y H:i:s',$row->timestamp).'</cite>
									</small>
								</blockquote>
							</div>
						</div>';
				}?>							
			</div>
		</div>
	</div>
</div>


