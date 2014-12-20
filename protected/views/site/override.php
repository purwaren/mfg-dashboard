<?php
$this->pageTitle=Yii::app()->name . ' - Session Override';
?>



<p style="text-align: center">Anda masih memiliki sesi aktif di mesin <b><?php echo $model->ip_address ?></b> sampai dengan <b><?php echo date('d/M/Y H:i:s',$model->valid_until)?> </b>, apakah anda tetap ingin melanjutkan?</p>

<div class="form mylogin">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>false,
	
)); ?>
	<div class="row">
		<?php echo CHtml::label('Verifikasi Password','password'); ?>
		<?php echo CHtml::passwordField('password','')?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Ya',array('name'=>'yes')); ?>
		<?php echo CHtml::submitButton('Tidak',array('name'=>'no')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
