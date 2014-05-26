<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Pengguna'=>array('index'),
	$model->name,
);

$this->menu=array(	
	array('label'=>'Tambah Pengguna', 'url'=>array('create')),
	array('label'=>'Ubah Pengguna', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Hapus Pengguna', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Apakah anda yakin menghapus item ini?')),
	array('label'=>'Kelola Pengguna', 'url'=>array('admin')),
);
?>

<h1>Detil Pengguna : <?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'username',		
		array(
			'name'=>'status',
			'value'=>$model->getStatus(),
		),
		array(
			'name'=>'created_time',
			'value'=>date('d F Y h:i:s', $model->created_time),
		),
		array(
			'name'=>'updated_time',
			'value'=>($model->updated_time)?date('d F Y h:i:s', $model->updated_time):'Tidak Pernah',
		),
		array(
			'name'=>'last_login_time',
			'value'=>($model->last_login_time)?date('d F Y h:i:s', $model->last_login_time):'Tidak Pernah',
		),		
		array(
			'name'=>'login_status',
			'value'=>$model->getLoginStatus(),
		),
		array(
			'name'=>'flag_delete',
			'value'=>$model->getDeleteStatus(),
		),
	),
)); ?>
