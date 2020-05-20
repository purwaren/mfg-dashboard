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
    <script data-ad-client="ca-pub-6718804203786731" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
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
				array('label'=>'Beranda', 'url'=>array('site/index'),
					'items'=>array(
						array('label'=>'Tulis Berita','url'=>array('/comment/create'),'visible'=>Yii::app()->user->checkAccess('owner')||Yii::app()->user->checkAccess('manajer1')||Yii::app()->user->checkAccess('manajer2')||Yii::app()->user->checkAccess('superadmin')),
						array('label'=>'Ganti Password','url'=>array('/users/password'),'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
					),
				),
				array('label'=>'Manajemen Pengguna','url'=>array(''),'visible'=>Yii::app()->user->checkAccess('superadmin'),
					'items'=>array(
							array('label'=>'Tambah Pengguna','url'=>array('/users/create'),'visible'=>$this->checkIfHasAccess('users','create')),
							array('label'=>'Pendaftaran Akses','url'=>array('/authitem/create'),'visible'=>$this->checkIfHasAccess('authitem','create'))
					),
				),				
				array('label'=>'Daftar Sikasir', 'url'=>array('/storeIp/admin'),'visible'=>$this->checkIfHasAccess('storeIp','admin')),
				//array('label'=>'Daftar Omset', 'url'=>array('/storeRevenue/admin'),'visible'=>$this->checkIfHasAccess('storeRevenue','admin')),
				//array('label'=>'Daftar Omset Koalisi', 'url'=>array('/storeRevenue/omsetGroup'),'visible'=>$this->checkIfHasAccess('storeRevenue','omsetGroup')),
				array('label'=>'Toko','url'=>array(''),'visible'=>!Yii::app()->user->isGuest,'url'=>array(''),
					'items'=> array(
						array('label'=>'Daftar Item Terjual', 'url'=>array('/soldItem/admin'),'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Rekap Penjualan Per Toko', 'url'=>array('/soldItem/rekap'),'visible'=>$this->checkIfHasAccess('soldItem','rekap')),
						array('label'=>'Rekap Penjualan Per Minggu', 'url'=>array('soldItem/weekly'),'visible'=>$this->checkIfHasAccess('soldItem','weekly')),
					)
				),					
				array('label'=>'Riwayat', 'visible'=>!Yii::app()->user->isGuest,'url'=>array(''),
					'items'=>array(
						array('label'=>'Riwayat Barang Toko', 'url'=>array('/itemHistory/admin'),'visible'=>$this->checkIfHasAccess('itemHistory','admin')),						
						array('label'=>'Riwayat Barang Gudang', 'url'=>array('/itemHistoryGudang/admin'),'visible'=>$this->checkIfHasAccess('itemHistoryGudang','admin')),
						array('label'=>'Riwayat Barang Jakarta', 'url'=>array('/itemHistory/adminJakarta'),'visible'=>$this->checkIfHasAccess('itemHistory','adminJakarta')), 						
					),
				),	
				array('label'=>'Rekap Penjualan', 'url'=>array('/itemHistory/adminJakartaSales'),'visible'=>$this->checkIfHasAccess('itemHistory','adminJakartaSales')),							
				array('label'=>'Rekap Global', 'url'=>array('/itemHistory/adminGlobal'),'visible'=>$this->checkIfHasAccess('itemHistory','adminGlobal')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
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
	<!-- my-add-1 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6718804203786731"
     data-ad-slot="1895565940"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div><!-- page -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-163132098-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-163132098-2');
</script>

</body>
</html>
