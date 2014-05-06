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

	<div class="row">
		<?php echo $form->label($model,'item_code'); ?>
		<?php echo $form->textField($model,'item_code',array('size'=>15,'maxlength'=>15)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'date_in'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
		    'name'=>'ItemHistory[date_in]',
			'value'=>$model->date_in,
		    // additional javascript options for the date picker plugin
		    'options'=>array(
		        'showAnim'=>'fold',
				'dateFormat'=>'yy-mm-dd'
		    ),
		    
		));?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->