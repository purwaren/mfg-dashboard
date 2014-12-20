<?php
/* @var $this SupplierController */
/* @var $data Supplier */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sup_code')); ?>:</b>
	<?php echo CHtml::encode($data->sup_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sup_name')); ?>:</b>
	<?php echo CHtml::encode($data->sup_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sup_address')); ?>:</b>
	<?php echo CHtml::encode($data->sup_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sup_phone')); ?>:</b>
	<?php echo CHtml::encode($data->sup_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sup_type')); ?>:</b>
	<?php echo CHtml::encode($data->sup_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('op_code')); ?>:</b>
	<?php echo CHtml::encode($data->op_code); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('entry_date')); ?>:</b>
	<?php echo CHtml::encode($data->entry_date); ?>
	<br />

	*/ ?>

</div>