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
			<td class="label-column"><?php echo $form->label($model,'sup_code'); ?></td>
			<td class="value-column"><?php echo $form->textField($model,'sup_code',array('class'=>'span-5','maxlength'=>15)); ?></td>
		</tr>	
		<tr>
			<td class="label-column"><?php echo $form->label($model,'month'); ?></td>
			<td class="value-column"><?php echo $form->textField($model,'month',array('class'=>'span-5','maxlength'=>15)); ?></td>
		</tr>	
		<tr>
			<td class="label-column"><?php echo $form->label($model,'item_code'); ?></td>
			<td class="value-column"><?php echo $form->textField($model,'item_code',array('class'=>'span-5','maxlength'=>15)); ?></td>
		</tr>		
		<tr>
			<td class="label-column"><?php echo $form->label($model,'sortBy'); ?></td>
			<td class="value-column"><?php echo $form->dropDownList($model,'sortBy',ItemHistoryJakarta::getAllSortOptions(),
				array('class'=>'span-5')); ?></td>
		</tr>
		<tr>
			<td class="label-column"><?php echo $form->label($model,'sortType'); ?></td>
			<td class="value-column"><?php echo $form->dropDownList($model,'sortType',ItemHistoryJakarta::getAllSortTypeOptions(),
				array('class'=>'span-5')); ?></td>
		</tr>
	</table>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Tampil'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->