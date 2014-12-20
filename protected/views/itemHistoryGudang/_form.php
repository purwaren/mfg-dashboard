<?php
/* @var $this ItemHistoryGudangController */
/* @var $model ItemHistoryGudang */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-history-gudang-form',
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
		<?php echo $form->labelEx($model,'supplier'); ?>
		<?php echo $form->textField($model,'supplier',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'supplier'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'capital_price'); ?>
		<?php echo $form->textField($model,'capital_price',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'capital_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'offer_price'); ?>
		<?php echo $form->textField($model,'offer_price',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'offer_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_in'); ?>
		<?php echo $form->textField($model,'date_in'); ?>
		<?php echo $form->error($model,'date_in'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_bon'); ?>
		<?php echo $form->textField($model,'date_bon'); ?>
		<?php echo $form->error($model,'date_bon'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_out'); ?>
		<?php echo $form->textField($model,'date_out'); ?>
		<?php echo $form->error($model,'date_out'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qty_in'); ?>
		<?php echo $form->textField($model,'qty_in'); ?>
		<?php echo $form->error($model,'qty_in'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qty_stock'); ?>
		<?php echo $form->textField($model,'qty_stock'); ?>
		<?php echo $form->error($model,'qty_stock'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qty_dist'); ?>
		<?php echo $form->textField($model,'qty_dist'); ?>
		<?php echo $form->error($model,'qty_dist'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->