<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'post',
)); ?>

	<table>
		<tr>
			<td class="label-column"><?php echo $form->label($model, 'cat_code'); ?></td>
			<td class="value-column"><?php echo $form->textField($model,'cat_code',array('class'=>'span-5','maxlength'=>3)); ?></td>
		</tr>		
	</table>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search')?>
	</div>
<?php $this->endWidget()?>
</div>