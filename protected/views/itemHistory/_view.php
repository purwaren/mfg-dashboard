<?php
/* @var $this ItemHistoryController */
/* @var $data ItemHistory */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_code')); ?>:</b>
	<?php echo CHtml::encode($data->item_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_in')); ?>:</b>
	<?php echo CHtml::encode($data->date_in); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qty_in')); ?>:</b>
	<?php echo CHtml::encode($data->qty_in); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qty_sold')); ?>:</b>
	<?php echo CHtml::encode($data->qty_sold); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('qty_stock')); ?>:</b>
	<?php echo CHtml::encode($data->qty_stock); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('period')); ?>:</b>
	<?php echo CHtml::encode($data->period); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('store_code')); ?>:</b>
	<?php echo CHtml::encode($data->store_code); ?>
	<br />

	*/ ?>

</div>