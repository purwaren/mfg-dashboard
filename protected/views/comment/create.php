<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs=array(
	'Berita'=>array(),
	'Tambah',
);

$this->menu=array(
	//array('label'=>'List Comment', 'url'=>array('index')),
	array('label'=>'Kelola Berita', 'url'=>array('admin')),
);
?>

<h1>Tambah Berita</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>