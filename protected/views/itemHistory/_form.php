<?php
/* @var $this ItemHistoryController */
/* @var $model ItemHistory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-history-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'item_code'); ?>
		<?php echo $form->textField($model,'item_code',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'item_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_in'); ?>
		<?php echo $form->textField($model,'date_in'); ?>
		<?php echo $form->error($model,'date_in'); ?>
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
		<?php echo $form->labelEx($model,'qty_stock'); ?>
		<?php echo $form->textField($model,'qty_stock'); ?>
		<?php echo $form->error($model,'qty_stock'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'period'); ?>
		<?php echo $form->textField($model,'period'); ?>
		<?php echo $form->error($model,'period'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'store_code'); ?>
		<?php echo $form->textField($model,'store_code',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'store_code'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->