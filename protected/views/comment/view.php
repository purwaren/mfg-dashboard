<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs=array(
	'Berita'=>array(),
	$model->title,
);

$this->menu=array(
	//array('label'=>'List Comment', 'url'=>array('index')),
	array('label'=>'Tambah Berita', 'url'=>array('create')),
	//array('label'=>'Update Comment', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Comment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Kelola Berita', 'url'=>array('admin')),
);
?>

<h1>Detil Berita: <?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'timestamp',
		'title',
		'content',
		'author',
		'status',
	),
)); ?>
