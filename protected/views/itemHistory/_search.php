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
			<td class="label-column"><?php echo CHtml::label('Kelompok / Kode Barang', 'item_code'); ?></td>
			<td class="value-column"><?php echo $form->textField($model,'item_code',array('class'=>'span-5','maxlength'=>15)); ?></td>
		</tr>
		<tr>
			<td class="label-column"><?php echo $form->label($model,'date_in'); ?></td>
			<td class="value-column"><?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
				    'name'=>'ItemHistory[date_in]',
					'value'=>$model->date_in,					
				    // additional javascript options for the date picker plugin
				    'options'=>array(
				        'showAnim'=>'fold',
						'dateFormat'=>'yy-mm-dd'
				    ),
					'htmlOptions'=>array('class'=>'span-5')
				    
				));?></td>
		</tr>
		<tr>
			<td class="label-column"><?php echo $form->label($model,'sortBy'); ?></td>
			<td class="value-column"><?php echo $form->dropDownList($model,'sortBy',ItemHistory::getAllSortOptions(),
				array('class'=>'span-5')); ?></td>
		</tr>
		<tr>
			<td class="label-column"><?php echo $form->label($model,'sortType'); ?></td>
			<td class="value-column"><?php echo $form->dropDownList($model,'sortType',ItemHistory::getAllSortTypeOptions(),
				array('class'=>'span-5')); ?></td>
		</tr>
	</table>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Tampil'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->