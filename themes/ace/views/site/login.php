<div class="main-content">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<div class="login-container">
				<div class="center">
					<h1>
						<i class="icon-bar-chart green"></i>
						<span class="red"><?php echo Yii::app()->name; ?></span>
					</h1>
					<h4 class="blue">&copy; <?php echo Yii::app()->params['company']['name']; ?></h4>
				</div>

				<div class="space-6"></div>

				<div class="position-relative">
					<div id="login-box" class="login-box visible widget-box no-border">
						<div class="widget-body">
							<div class="widget-main">
								<h4 class="header blue lighter bigger">
									<i class="icon-coffee green"></i>
									Silakan masukan login anda
								</h4>
								<div class="space-6"></div>

								<?php $form=$this->beginWidget('CActiveForm', array(
									'id'=>'login-form',									
								)); ?>
									<fieldset>
										<label class="block clearfix">
											<span class="block input-icon input-icon-right">
												<?php echo $form->textField($model,'username',array(
													'class'=>'form-control',
													'placeholder'=>'Username'
												))?>												
												<i class="icon-user"></i>
											</span>
										</label>

										<label class="block clearfix">
											<span class="block input-icon input-icon-right">
												<?php echo $form->passwordField($model,'password',array(
													'class'=>'form-control',
													'placeholder'=>'Password'
												))?>												
												<i class="icon-lock"></i>
											</span>
										</label>

										<div class="space"></div>

										<div class="clearfix">
											<label class="inline">
												<?php echo $form->checkBox($model,'rememberMe', array(
													'class'=>'ace'
												))?>												
												<span class="lbl"> Ingat saya</span>
											</label>											
											<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
												<i class="icon-key"></i>
												Login
											</button>
										</div>
										<div class="space-4"></div>
									</fieldset>
								<?php $this->endWidget() ?>
								<?php echo $form->errorSummary($model,'','',array('class'=>'alert alert-danger'))?>															
							</div><!-- /widget-main -->							
						</div><!-- /widget-body -->
					</div><!-- /login-box -->					
				</div><!-- /position-relative -->
			</div>
		</div><!-- /.col -->
	</div><!-- /.row -->
</div>