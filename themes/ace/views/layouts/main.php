<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->

		<link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->

		<!-- fonts -->

		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/ace-fonts.css" />

		<!-- ace styles -->

		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/ace.min.css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/special.css" />
		<!-- ace settings handler -->

		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/ace-extra.min.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/html5shiv.js"></script>
		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<div class="navbar navbar-default" id="navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>			
			<div class="navbar-container" id="navbar-container">				
				<div class="navbar-header pull-left">					
					<a href="<?php echo Yii::app()->request->baseUrl; ?>" class="navbar-brand">						
						<small>		
							<i class="icon-book">					
								<?php echo CHtml::encode($this->pageTitle); ?>
							</i>
						</small>
					</a><!-- /.brand -->
				</div><!-- /.navbar-header -->			

				<div class="navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">				
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php echo Yii::app()->theme->baseUrl?>/assets/avatars/avatar.png" alt="User's photo">
								<span class="user-info">
									<small>Selamat Datang,</small>
									<?php echo Yii::app()->user->name;?>
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<?php echo CHtml::link('<i class="icon-key"></i> Ganti Password',array('users/password')); ?>									
								</li>

								<li>
									<?php echo CHtml::link('<i class="icon-eye-open"></i>Profil Pengguna',array('users/'.Yii::app()->user->getId().'')); ?>							
								</li>

								<li class="divider"></li>

								<li>
									<?php echo CHtml::link('<i class="icon-off"></i> Logout',array('site/logout')); ?>									
								</li>
							</ul>
						</li>
					</ul><!-- /.ace-nav -->
				</div><!-- /.navbar-header -->
			</div><!-- /.container -->
		</div>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')} catch(e){}
			</script>

			<div class="main-container-inner">
				<a class="menu-toggler" id="menu-toggler" href="#">
					<span class="menu-text  blue"></span>
				</a>

				<div class="sidebar" id="sidebar">
					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
					</script>
					<div class="sidebar-shortcuts" id="sidebar-shortcuts">
						<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
							<small>MENU</small>
						</div>
					</div>
					<?php $this->widget('zii.widgets.CMenu', array(
						'items' => array(
							array(
								'label' => '<i class="icon-cogs blue"></i><span class="menu-text  blue">Konfigurasi Sistem</span> <b class="arrow icon-angle-down"></b>',
								'url' => '#',
// 								'visible'=>Yii::app()->user->checkAccess('superadmin'),
								'linkOptions'=> array(
									'class' => 'dropdown-toggle',
									'data-toggle' => 'dropdown',
									),
								'itemOptions' => array('class'=>'dropdown user'),
								'items' => array(
									array('label'=>'<i class="icon-double-angle-right blue"></i> Manajemen Pengguna','url'=>array('users/admin'),'visible'=>$this->checkIfHasAccess('users','admin')),
									array('label'=>'<i class="icon-double-angle-right blue"></i> Manajemen Hak Akses', 'url'=>'#',
										'linkOptions'=> array(
										'class' => 'dropdown-toggle',
										'data-toggle' => 'dropdown',
										),
										'items'=>array(
											array('label'=>'Perbarui Akses','url'=>array('authitem/refresh'),'visible'=>$this->checkIfHasAccess('authitem','refresh')),
											array('label'=>'Pendaftaran Akses','url'=>array('authitem/create'),'visible'=>$this->checkIfHasAccess('authitem','create')),
											array('label'=>'Pengaturan Akses','url'=>Yii::app()->createUrl('authitem/admin',array('type'=>CAuthItem::TYPE_OPERATION)),'visible'=>$this->checkIfHasAccess('authitem','admin')),								
											array('label'=>'Pengaturan Peran','url'=>Yii::app()->createUrl('authitem/admin',array('type'=>CAuthItem::TYPE_ROLE)),'visible'=>$this->checkIfHasAccess('authitem','admin')),
										),
										'submenuHtmlOptions' => array(
											'class' => 'submenu',
										)
									),
								)
								
							),	
							array(
								'label'=>'<i class="icon-desktop blue"></i><span class="menu-text blue">Daftar Sikasir</span>',
								'url'=>array('storeIp/admin'),
								'visible'=>$this->checkIfHasAccess('storeIp','admin')						
							),	
							array(
								'label'=>'<i class="icon-shopping-cart blue"></i><span class="menu-text blue">Toko</span><b class="arrow icon-angle-down"></b>',
								'url'=>'#',
								'visible'=>!Yii::app()->user->isGuest,
								'linkOptions'=> array(
									'class' => 'dropdown-toggle',
									'data-toggle' => 'dropdown',
								),
								'itemOptions' => array('class'=>'dropdown user'),
								'items' => array(
									array('label'=>'Daftar Item Terjual', 'url'=>array('/soldItem/admin'),'visible'=>!Yii::app()->user->isGuest),
									array('label'=>'Rekap Penjualan Toko', 'url'=>array('/soldItem/rekap'),'visible'=>$this->checkIfHasAccess('soldItem','rekap')),
								),
								'submenuHtmlOptions' => array(
									'class' => 'submenu',
								)
							),											
						),
						'encodeLabel' => false,
						'htmlOptions' => array(
							'class'=>'nav nav-list',
								),
						'submenuHtmlOptions' => array(
							'class' => 'submenu',
						)
					));?>
					<!-- /.nav-list -->

					<div class="sidebar-collapse" id="sidebar-collapse">
						<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
					</div>

					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'collapsed')} catch(e){}
					</script>
				</div>

				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')} catch(e){}
						</script>
						
						<?php if(isset($this->breadcrumbs)):
 
						if ( Yii::app()->controller->route !== 'site/index' )
							$this->breadcrumbs = array_merge(array (Yii::t('zii','Home')=>Yii::app()->homeUrl), $this->breadcrumbs);
					 
						$this->widget('ext.EBreadcrumbs', array(
							'links'=>$this->breadcrumbs,
							'homeLink'=>false,
							'tagName'=>'ul',
							'separator'=>'',
							'activeLinkTemplate'=>'<li>{home}<a href="{url}">{label}</a> <span class="divider"></span></li>',
							'inactiveLinkTemplate'=>'<li><span>{label}</span></li>',
							'htmlOptions'=>array ('class'=>'breadcrumb')
						)); ?><!-- breadcrumbs -->
						<?php endif; ?>
					
					</div>
					<div class="page-content">
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->											
								<?php echo $content; ?>
								<!-- PAGE CONTENT ENDS -->
								
							</div><!-- /.col -->							
						</div><!-- /.row -->
						<div id="footer">
							Copyright &copy; <?php echo date('Y'); ?> Putra Muda Mandiri.<br/>
							All Rights Reserved.<br/>
							<?php echo Yii::powered(); ?>
						</div>
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->
				
			</div><!-- /.main-container-inner -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="icon-double-angle-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/bootstrap.min.js"></script>
		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/typeahead-bs2.min.js"></script>

		<!-- page specific plugin scripts -->

		<!-- ace scripts -->

		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/ace-elements.min.js"></script>
		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
	</body>
</html>
