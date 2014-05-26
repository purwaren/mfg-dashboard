<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Pengguna'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Ubah',
);

$this->menu=array(	
	array('label'=>'Tambah Pengguna', 'url'=>array('create')),
	array('label'=>'Detil Pengguna', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Kelola Pengguna', 'url'=>array('admin')),
);
?>

<h1>Ubah Pengguna : <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>