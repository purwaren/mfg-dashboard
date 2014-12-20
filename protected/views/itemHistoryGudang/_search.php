<?php
/* @var $this ItemHistoryGudangController */
/* @var $model ItemHistoryGudang */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
)); ?>

	<table>
		<tr>
			<td class="label-column"><?php echo $form->label($model,'item_code'); ?></td>
			<td class="value-column"><?php echo $form->textField($model,'item_code',array('size'=>15,'maxlength'=>15)); ?></td>
		</tr>
		<tr>
			<td class="label-column"><?php echo $form->label($model,'date_in'); ?></td>
			<td class="value-column"><?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
			    'name'=>'ItemHistoryGudang[date_in]',
				'value'=>$model->date_in,
			    // additional javascript options for the date picker plugin
			    'options'=>array(
			        'showAnim'=>'fold',
					'dateFormat'=>'yy-mm-dd'
			    ),	
				'htmlOptions'=>array('id'=>'date_in')
			)); ?></td>
		</tr>
		<tr>
			<td class="label-column"><?php echo $form->label($model,'date_bon'); ?></td>
			<td class="value-column"><?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
			    'name'=>'ItemHistoryGudang[date_bon]',
				'value'=>$model->date_bon,
			    // additional javascript options for the date picker plugin
			    'options'=>array(
			        'showAnim'=>'fold',
					'dateFormat'=>'yy-mm-dd'
			    ),	
				'htmlOptions'=>array('id'=>'date_bon')		    
			)); ?></td>
		</tr>
		<tr>
			<td class="label-column"><?php echo $form->label($model,'date_out'); ?></td>
			<td class="value-column"><?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
			    'name'=>'ItemHistoryGudang[date_out]',
				'value'=>$model->date_out,
			    // additional javascript options for the date picker plugin
			    'options'=>array(
			        'showAnim'=>'fold',
					'dateFormat'=>'yy-mm-dd'
			    ),	
					'htmlOptions'=>array('id'=>'date_out')
			)); ?></td>
		</tr>
		<tr>
			<td class="label-column"><?php echo $form->label($model,'supplier'); ?></td>
			<td class="value-column"><?php echo $form->textField($model,'supplier',array('size'=>8,'maxlength'=>8)); ?></td>
		</tr>
		<tr>
			<td class="label-column"><?php echo $form->label($model,'sortBy'); ?></td>
			<td class="value-column"><?php echo $form->dropDownList($model,'sortBy',ItemHistoryGudang::getAllSortOptions()); ?></td>
		</tr>		
		<tr>
			<td class="label-column"><?php echo $form->label($model,'sortType'); ?></td>
			<td class="value-column"><?php echo $form->dropDownList($model,'sortType',array(
				'ASC'=>'Kecil ke Besar',
				'DESC'=>'Besar ke Kecil'
			)); ?></td>
		</tr>
	</table>
	
	

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->