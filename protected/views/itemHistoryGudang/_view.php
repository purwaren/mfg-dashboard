<?php
/* @var $this ItemHistoryGudangController */
/* @var $data ItemHistoryGudang */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('supplier')); ?>:</b>
	<?php echo CHtml::encode($data->supplier); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('capital_price')); ?>:</b>
	<?php echo CHtml::encode($data->capital_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('offer_price')); ?>:</b>
	<?php echo CHtml::encode($data->offer_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_in')); ?>:</b>
	<?php echo CHtml::encode($data->date_in); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('date_bon')); ?>:</b>
	<?php echo CHtml::encode($data->date_bon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_out')); ?>:</b>
	<?php echo CHtml::encode($data->date_out); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qty_in')); ?>:</b>
	<?php echo CHtml::encode($data->qty_in); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qty_stock')); ?>:</b>
	<?php echo CHtml::encode($data->qty_stock); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qty_dist')); ?>:</b>
	<?php echo CHtml::encode($data->qty_dist); ?>
	<br />

	*/ ?>

</div>