<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Isian bertanda<span class="required">*</span> tidak bole dikosongkan.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<table>
		<tr>
			<td class="label-column"><?php echo $form->labelEx($model,'name'); ?></td>
			<td class="value-column"><?php echo $form->textField($model,'name',array('class'=>'medium-text','maxlength'=>128)); ?></td>
		</tr>
		<tr>
			<td class="label-column"><?php echo $form->labelEx($model,'username'); ?></td>
			<td class="value-column"><?php echo $form->textField($model,'username',array('class'=>'medium-text','maxlength'=>16)); ?></td>
		</tr>
		<?php if($model->isNewRecord) { ?>
		<tr>
			<td class="label-column"><?php echo $form->labelEx($model,'passwd'); ?></td>
			<td class="value-column"><?php echo $form->passwordField($model,'passwd',array('class'=>'medium-text','maxlength'=>32)); ?></td>
		</tr>
		<?php } ?>
		<tr>
			<td class="label-column"><?php echo $form->labelEx($model,'status'); ?></td>
			<td class="value-column"><?php echo $form->dropDownList($model,'status', Users::getAllStatusOptions(),
			array('prompt'=>'Pilih Status')); ?></td>
		</tr>		
	</table>	

	<div class="row buttons">
		<?php echo CHtml::submitButton('Simpan'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->