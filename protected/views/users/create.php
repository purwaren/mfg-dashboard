<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Pengguna'=>array('index'),
	'Tambah',
);

$this->menu=array(	
	array('label'=>'Kelola Pengguna', 'url'=>array('admin')),
);
?>

<h1>Tambah Pengguna</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>