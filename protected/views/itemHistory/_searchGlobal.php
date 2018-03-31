<?php
/* @var $this ItemHistoryController */
/* @var $model ItemHistoryGlobal */
//$this->widget( 'ext.EChosen.EChosen' );
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
)); ?>

	<table>
		<tr>
			<td class="label-column"><?php echo CHtml::label('Kelompok Barang', 'cat_code'); ?></td>
			<td class="value-column"><?php $this->widget('ext.select2.ESelect2', array(
                    'model' => $model,
                    'attribute' => 'cat_code',
                    'data' => ItemHistoryGlobal::getAllCategoryOptions(),
                    'htmlOptions'=>array('style'=>'width: 300px;')
                )); ?></td>
		</tr>
	</table>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Tampil'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->