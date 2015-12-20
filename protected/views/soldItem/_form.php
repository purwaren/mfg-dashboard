<?php
/* @var $this SoldItemController */
/* @var $model SoldItem */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sold-item-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category'); ?>
		<?php echo $form->textField($model,'category',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'category'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'trx_date'); ?>
		<?php echo $form->textField($model,'trx_date'); ?>
		<?php echo $form->error($model,'trx_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qty_in'); ?>
		<?php echo $form->textField($model,'qty_in'); ?>
		<?php echo $form->error($model,'qty_in'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qty_sold'); ?>
		<?php echo $form->textField($model,'qty_sold'); ?>
		<?php echo $form->error($model,'qty_sold'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shop_code'); ?>
		<?php echo $form->textField($model,'shop_code',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'shop_code'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->