<?php
/* @var $this AuthitemController */
/* @var $model Authitem */

$this->breadcrumbs=array(
	'Hak Akses'=>array('index'),
	'Pendaftaran Akses / Peran',
);

$this->menu=array(
	array('label'=>'Pengaturan Akses', 'url'=>array('admin')),
	array('label'=>'Pengaturan Peran', 'url'=>array('admin','type'=>CAuthItem::TYPE_ROLE)),
);
?>

<h1>Pendaftaran Akses / Peran</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>