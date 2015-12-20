<?php
/* @var $this SoldItemController */
/* @var $model SoldItem */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
)); ?>

	<table>
		<tr>
			<td class="label-column"><?php echo $form->label($model,'shop_code'); ?></td>
			<td class="value-column"><?php echo $form->dropDownList($model,'shop_code',Store::getAllStoreOptions(),
					array('class'=>'span-5','prompt'=>'Pilih Toko')); ?></td>
		</tr>
		<tr>
			<td class="label-column"><?php echo $form->label($model,'trx_date'); ?></td>
			<td class="value-column">
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
				    'name'=>'SoldItem[start_date]',
					'value'=>$model->start_date,					
				    // additional javascript options for the date picker plugin
				    'options'=>array(
				        'showAnim'=>'fold',
						'dateFormat'=>'yy-mm-dd'
				    ),
					
				    
				));?> s.d.
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
				    'name'=>'SoldItem[end_date]',
					'value'=>$model->end_date,					
				    // additional javascript options for the date picker plugin
				    'options'=>array(
				        'showAnim'=>'fold',
						'dateFormat'=>'yy-mm-dd'
				    ),
					
				    
				));?>
			</td>
		</tr>
		<tr>
			<td class="label-column"><?php echo $form->label($model,'sortBy'); ?></td>
			<td class="value-column"><?php echo $form->dropDownList($model,'sortBy',SoldItem::getAllSortOptions(),
				array('class'=>'span-5')); ?></td>
		</tr>
		<tr>
			<td class="label-column"><?php echo $form->label($model,'sortType'); ?></td>
			<td class="value-column"><?php echo $form->dropDownList($model,'sortType',SoldItem::getAllSortTypeOptions(),
				array('class'=>'span-5')); ?></td>
		</tr>
	</table>

	

	<div class="row buttons">
		<?php echo CHtml::submitButton('Tampil'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->