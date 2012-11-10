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
			<td class="label-column"><?php echo $form->label($model,'store_code'); ?></td>
			<td class="value-column"><?php echo $form->dropDownList($model,'store_code',StoreIp::getAllStoreCode(),
					array('prompt'=>'Pilih Toko')); ?></td>
		</tr>
		<tr>
			<td class="label-column"><?php echo $form->label($model,'date'); ?></td>
			<td class="value-column"><?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
					'name'=>'StoreRevenue[date]',
					'options'=>array('showAnim'=>'fold','dateFormat'=>'yy-mm-dd'),
					'value'=>$model->date
			)); ?></td>
		</tr>
		<tr>
			<td class="label-column"><?php echo $form->label($model,'current_revenue'); ?></td>
			<td class="value-column"><?php echo $form->textField($model,'current_revenue'); ?></td>
		</tr>
	</table>	

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->