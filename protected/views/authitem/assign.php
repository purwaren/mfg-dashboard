<?php
/* @var $this AuthitemController */
/* @var $model Authitem */

$this->breadcrumbs=array(
	'Hak Akses'=>array('index'),
	'Perbarui Akses',
);

$this->menu=array(
	array('label'=>'Pengaturan Akses', 'url'=>array('admin','type'=>CAuthItem::TYPE_OPERATION)),
	array('label'=>'Pengaturan Peran', 'url'=>array('admin','type'=>CAuthItem::TYPE_ROLE)),
);
?>

<h1>Penugasan Peran Kepada : <?php echo $model->username?></h1>

<div class="form grid-view">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'authitem-form',
	'enableAjaxValidation'=>false,
));
?>
	<p class="note">Anda bisa menambahkan atau mencabut peran yang sudah dimiliki oleh pengguna ini.</p>
	
	<?php
	$row_data=''; 
	
	foreach($roles as $row){
		$access = $auth->isAssigned($row->name, $model->id);
		$row_data .= '<tr>
			<td>'.CHtml::checkBox('roles[]',$access,array('value'=>$row->name)).'&nbsp;'.ucfirst($row->name).'</td>
			<td>'.ucfirst($row->description).'</td>
		</tr>';
		
	}?>
	<table class="items">
		<thead>
			<tr>
				<th>Nama Peran</th>				
				<th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $row_data?>
		</tbody>
	</table>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Simpan',array('name'=>'Save')); ?>
	</div>
	<p style="color: green"><?php if(isset($message)) echo $message?></p>
<?php $this->endWidget(); ?>

</div><!-- form -->

