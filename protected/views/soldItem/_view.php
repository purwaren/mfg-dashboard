<?php
/* @var $this SoldItemController */
/* @var $data SoldItem */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
	<?php echo CHtml::encode($data->category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trx_date')); ?>:</b>
	<?php echo CHtml::encode($data->trx_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qty_in')); ?>:</b>
	<?php echo CHtml::encode($data->qty_in); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qty_sold')); ?>:</b>
	<?php echo CHtml::encode($data->qty_sold); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shop_code')); ?>:</b>
	<?php echo CHtml::encode($data->shop_code); ?>
	<br />


</div>