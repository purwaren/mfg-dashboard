<?php
$this->pageTitle=Yii::app()->name . ' - Session Override';
?>
<div class="col-sm6 center">
	<div class="alert alert-warning">		
		<strong>
			<i class="icon-lock"></i>
			Anda masih memiliki sesi aktif di mesin <b><?php echo $model->ip_address ?></b> sampai dengan <b><?php echo date('d/M/Y H:i:s',$model->valid_until)?> </b>, apakah anda tetap ingin melanjutkan?
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'login-form',
				'enableClientValidation'=>false,
				
			)); ?>
				<br /	>
				<div class="row">
					<?php echo CHtml::label('Verifikasi Password','password'); ?>
					<?php echo CHtml::passwordField('password','')?>
				</div>
				<br />
				<div class="row buttons">
					<?php echo CHtml::submitButton('Ya',array('name'=>'yes','class'=>'btn btn-sm btn-success')); ?>
					<?php echo CHtml::submitButton('Tidak',array('name'=>'no','class'=>'btn btn-sm')); ?>
				</div>
			
			<?php $this->endWidget(); ?>	
		<br>
	</div>
</div>
<p style="text-align: center"></p>

<div class="form mylogin">

</div><!-- form -->
