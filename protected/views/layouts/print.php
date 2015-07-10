<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

		
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<?php Yii::app()->clientScript->registerCss('css',"
	/* reset.css */
	html {margin:0;padding:0;border:0;}
	body, div, span, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, code, del, dfn, em, img, q, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, dialog, figure, footer, header, hgroup, nav, section {margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline;}
	article, aside, details, figcaption, figure, dialog, footer, header, hgroup, menu, nav, section {display:block;}
	body {line-height:1.5;background:white;}
	table {border-collapse:separate;border-spacing:0;}
	caption, th, td {text-align:left;font-weight:normal;float:none !important;}
	table, th, td {vertical-align:middle;}
	blockquote:before, blockquote:after, q:before, q:after {content:'';}
	blockquote, q {quotes:\"\" \"\";}
	a img {border:none;}
	:focus {outline:0;}
	.pdf-container {
		width: 100%;
		font-size: 10pt;
	}
	.pdf-container #header {
		height: 70px;
		border-bottom: 2px solid;
		padding: 5px 5px 5px 5px;
		margin-bottom: 10px;	
			
	}
	#header #header-text {		
		margin: 5px 0 10px 80px;
	}
	#header img {
		float: left;		
	}
	#header h2, #header h3 {
		margin: 0px;
	}
	.grid-view {
		text-align:center;
	}
	
	.grid-view table {
		border-top: 1px solid;
		border-right: 1px solid;
		display: inline-table;
	}
	.grid-view table th{
		border-left: #333 1px solid;
		border-bottom: 1px solid;
		text-align: center;
		padding: 0px 5px 0px 5px;
		font-weight: bold;
		background-color: #ddd;
	}
	.grid-view table td {
		border-left: #555 1px solid;
		border-bottom: 1px solid;
		padding: 0px 5px 0px 5px;
	}
	.grid-view h3 {
		font-weight:bold;
		margin-bottom: 10px;
	}
");
Yii::app()->clientScript->registerScript('print',"
	window.print();
");?>
<body>
<div class="container pdf-container">
	<div id="header">
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/css/logo.png','logo',array('width'=>'70'))?>
		<div id="header-text">
			<h2>MODE FASHION GROUP</h2>
			<h3>Jalan Laksana No 68 ABC, Medan<br />Telp. (061) 7762452</h3>
		</div>
	</div>
	<?php echo $content; ?>
</div><!-- page -->
</body>
</html>
