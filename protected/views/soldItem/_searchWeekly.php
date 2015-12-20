<?php
/* @var $this SoldItemController */
/* @var $model SoldItem */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
)); ?>

	<table>
		<tr>
			<td class="label-column"><?php echo $form->label($model,'start_date'); ?></td>
			<td class="value-column">
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
				    'name'=>'SaleItemsWeekly[start_date]',
					'value'=>$model->start_date,					
				    // additional javascript options for the date picker plugin
				    'options'=>array(
				        'showAnim'=>'fold',
						'dateFormat'=>'yy-mm-dd'
				    ),
					
				    
				));?>
			</td>
		</tr>
		<tr>
			<td class="label-column"><?php echo $form->label($model,'end_date'); ?></td>
			<td class="value-column">
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'name'=>'SaleItemsWeekly[end_date]',
						'value'=>$model->end_date,
					// additional javascript options for the date picker plugin
						'options'=>array(
								'showAnim'=>'fold',
								'dateFormat'=>'yy-mm-dd'
						),


				));?>
			</td>
		</tr>
	</table>

	

	<div class="row buttons">
		<?php echo CHtml::submitButton('Tampil'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->