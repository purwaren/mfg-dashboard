<?php
/* @var $this StoreRevenueController */
/* @var $model StoreRevenue */
/* @var $form CActiveForm */
?>

<div class="row search-form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'form-horizontal','role'=>'form'),
)); ?>

	<div class="form-group">
		<?php echo $form->label($model,'date',array('class'=>'col-sm-3 control-label no-padding-right')); ?>
		<div class="col-sm-9">
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
					'name'=>'StoreRevenue[date]',
					'options'=>array('showAnim'=>'fold','dateFormat'=>'yy-mm-dd'),
					'value'=>$model->date,	
					'htmlOptions'=>array('class'=>'col-xs-10 col-sm-2')				
			)); ?>
			
		</div>
	</div>
	
	<div class="form-group">
		<?php echo $form->label($model,'date_to',array('class'=>'col-sm-3 control-label no-padding-right')); ?>
		<div class="col-sm-9">
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
					'name'=>'StoreRevenue[date_to]',
					'options'=>array('showAnim'=>'fold','dateFormat'=>'yy-mm-dd'),
					'value'=>$model->date_to,	
					'htmlOptions'=>array('class'=>'col-xs-10 col-sm-2')				
			)); ?>
			
		</div>
	</div>		

	<div class="clearfix form-actions">
		<div class="col-md-offset-3 col-md-9">
			<?php echo CHtml::htmlButton(
			'<i class="icon-fa-search bigger-110"></i>
				Tampilkan',
				array(
					'class'=>'btn btn-info',
					'type'=>'submit'
				))
			?>					
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->