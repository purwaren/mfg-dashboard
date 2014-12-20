<?php
/* @var $this SupplierController */
/* @var $model Supplier */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'supplier-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'sup_code'); ?>
		<?php echo $form->textField($model,'sup_code',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'sup_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sup_name'); ?>
		<?php echo $form->textField($model,'sup_name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'sup_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sup_address'); ?>
		<?php echo $form->textField($model,'sup_address',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'sup_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sup_phone'); ?>
		<?php echo $form->textField($model,'sup_phone',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'sup_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sup_type'); ?>
		<?php echo $form->textField($model,'sup_type',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'sup_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'op_code'); ?>
		<?php echo $form->textField($model,'op_code'); ?>
		<?php echo $form->error($model,'op_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'entry_date'); ?>
		<?php echo $form->textField($model,'entry_date'); ?>
		<?php echo $form->error($model,'entry_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->