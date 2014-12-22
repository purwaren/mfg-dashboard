<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo">Mode Fashion Group <br /> Dashboard Monitoring</div>
	</div><!-- header -->

	<div id="top_menu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Beranda', 'url'=>array('/site/index')),
				array('label'=>'Manajemen Pengguna',
					'items'=>array(
							array('label'=>'Tambah Pengguna','url'=>array('/users/create'),'visible'=>$this->checkIfHasAccess('users','create')),
							array('label'=>'Pendaftaran Akses','url'=>array('/authitem/create'),'visible'=>$this->checkIfHasAccess('authitem','create'))
					),
				),				
				array('label'=>'Daftar Sikasir', 'url'=>array('/storeIp/admin'),'visible'=>$this->checkIfHasAccess('storeIp','admin')),
				array('label'=>'Daftar Omset', 'url'=>array('/storeRevenue/admin'),'visible'=>$this->checkIfHasAccess('storeRevenue','admin')),
				array('label'=>'Daftar Item', 'url'=>array('/soldItem/admin')),
				array('label'=>'Riwayat Barang', 'url'=>array('/itemHistory/admin'),'visible'=>$this->checkIfHasAccess('itemHistory','admin')),
				array('label'=>'Riwayat Barang Gudang', 'url'=>array('/itemHistoryGudang/admin'),'visible'=>$this->checkIfHasAccess('itemHistoryGudang','admin')),
				array('label'=>'Riwayat Barang Jakarta', 'url'=>array('/itemHistory/adminJakarta'),'visible'=>$this->checkIfHasAccess('itemHistory','adminJakarta')),
				array('label'=>'Rekap Penjualan', 'url'=>array('/itemHistory/adminJakartaSales'),'visible'=>$this->checkIfHasAccess('itemHistory','adminJakartaSales')),
				array('label'=>'Ganti Password','url'=>array('/users/password'),'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> Mode Fashion Group.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
