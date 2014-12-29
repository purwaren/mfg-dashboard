<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Pengguna'=>array('index'),
	'Kelola',
);

$this->menu=array(	
	array('label'=>'Tambah Pengguna', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Kelola Pengguna</h1>

<p>
Anda boleh menggunakan operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) untuk menentukan perbandingan pada awal setiap kata kunci pencarian.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'No',
			'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1'
		),
		'name',
		'username',		
		array(
			'name'=>'status',
			'value'=>'$data->getStatus()'
		),
		array(
			'name'=>'created_time',
			'value'=>'date("d M Y H:i:s",$data->created_time)'
		),
		array(
			'name'=>'last_login_time',
			'value'=>'($data->last_login_time>0)?date("d M Y H:i:s",$data->last_login_time):"Belum Pernah"'
		),
		
		array(
			'class'=>'CButtonColumn',
			'template'=>'{role}&nbsp;{view}&nbsp;{update}&nbsp;{delete}',
			'buttons'=>array(
				'role'=>array(
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon/role.jpg',
					'label'=>'Penugasan Peran',
					'url'=>'Yii::app()->createUrl("authitem/assign",array("id"=>$data->id))'
				),
			),
			'htmlOptions'=>array('style'=>'width:80px')
		),
	),
)); ?>
