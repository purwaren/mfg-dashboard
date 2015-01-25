<?php
/* @var $this StoreRevenueController */
/* @var $model StoreRevenue */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<table>
		
		<tr>
			<td class="label-column"><?php echo $form->label($model,'date'); ?></td>
			<td class="value-column">
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
					'name'=>'StoreRevenue[date]',
					'options'=>array('showAnim'=>'fold','dateFormat'=>'yy-mm-dd'),
					'value'=>$model->date,
					'htmlOptions'=>array('style'=>'width: 70px')
			)); ?>
			s.d.
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
					'name'=>'StoreRevenue[date_to]',
					'options'=>array('showAnim'=>'fold','dateFormat'=>'yy-mm-dd'),
					'value'=>$model->date_to,
					'htmlOptions'=>array('style'=>'width: 70px')
			)); ?>
			</td>
		</tr>
		
	</table>	

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->