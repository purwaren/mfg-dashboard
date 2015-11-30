<?php $this->beginContent('//layouts/main'); ?>
<div class="col-xs-10">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="col-xs-2">
	<div id="row">
	<h4 class="header smaller lighter blue">Operasi</h4>
		<div class="dd">
		<?php		
	 		$this->widget('ext.ESidebarMenu', array(
	 			'items'=>$this->menu,
	 			'htmlOptions'=>array('class'=>'dd-list'),
				'itemTemplate'=>'<div class="dd-handle dd2-side-icon"><i class="icon-reorder blue bigger-130"></i></div>
				<div class="dd2-side-content">{menu}</div>'
	 		));		
		?>
		</div>		
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>