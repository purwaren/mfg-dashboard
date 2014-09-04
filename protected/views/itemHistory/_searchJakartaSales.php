<?php
/* @var $this ItemHistoryController */
/* @var $model ItemHistory */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
)); ?>

	<table>
		<tr>
			<td class="label-column"><?php echo CHtml::label('Kelompok Barang', 'item_code'); ?></td>
			<td class="value-column"><?php echo $form->textField($model,'item_code',array('class'=>'span-5','maxlength'=>3)); ?></td>
		</tr>
		<tr>
			<td class="label-column"><?php echo $form->label($model,'start_date'); ?></td>
			<td class="value-column"><?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
				    'name'=>'ItemJakartaSales[start_date]',
					'value'=>$model->start_date,					
				    // additional javascript options for the date picker plugin
				    'options'=>array(
				        'showAnim'=>'fold',
						'dateFormat'=>'yy-mm-dd'
				    ),
					'htmlOptions'=>array('style'=>'width: 80px')
				    
				));?> s.d. 
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
				    'name'=>'ItemJakartaSales[end_date]',
					'value'=>$model->end_date,					
				    // additional javascript options for the date picker plugin
				    'options'=>array(
				        'showAnim'=>'fold',
						'dateFormat'=>'yy-mm-dd'
				    ),
					'htmlOptions'=>array('style'=>'width: 80px')
				    
				));?></td>
		</tr>
		<tr>
			<td class="label-column"><?php echo CHtml::label('Toko Cabang', 'store_code'); ?></td>
			<td class="value-column"><?php echo $form->dropDownList($model,'store_code',Store::getAllStoreOptions(),
					array('class'=>'span-5','prompt'=>'Pilih Toko')); ?></td>
		</tr>
	</table>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Tampil'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->