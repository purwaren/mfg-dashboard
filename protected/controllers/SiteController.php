<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		if(Yii::app()->user->isGuest)
			Yii::app()->user->loginRequired();
		
		$model=new StoreRevenue('search');
		$model->unsetAttributes();  // clear any default values
		$model->date = date('Y-m-d');
		if(isset($_GET['StoreRevenue']))
			$model->attributes=$_GET['StoreRevenue'];
		
		$omset = $model->getOmsetByGroup();
		
		$this->render('index',array(
			'model'=>$model,
			'omset'=>$omset
		));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if(isset(Yii::app()->theme))
			$this->layout="//layouts/login";
		
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate())
			{
				//check if there is existing session
				$exist = Session::model()->findByAttributes(array(
					'userid'=>$model->username,					
				));
				
				if($exist)
				{					
					if($exist->valid_until > time())
					{
						Yii::app()->user->setState('existing_key', $exist->session_key);
						Yii::app()->user->setState('uname', $model->username);
						$this->render('override',array(
							'model'=>$exist,
						));	
						Yii::app()->end();
					}
					else 				
					{
						$exist->delete();
						$model->login();
						//create new session for this user
						$session = new Session();
						$session->userid = Yii::app()->user->getName();
						$session->session_key = $this->generateRandomString(32);
						$session->valid_until = time()+Yii::app()->params['timeout'];
						$session->ip_address = $_SERVER['REMOTE_ADDR'];
						if($session->save())
						{
							Yii::app()->user->setState('session_key', $session->session_key);
							$this->redirect(Yii::app()->user->returnUrl);
						}
					}
				}
				else
				{	
					$model->login();
					//create new session for this user					
					$session = new Session();
					$session->userid = Yii::app()->user->getName();
					$session->session_key = $this->generateRandomString(32);
					$session->valid_until = time()+Yii::app()->params['timeout'];
					$session->ip_address = $_SERVER['REMOTE_ADDR'];
					if($session->save())
					{
						Yii::app()->user->setState('session_key', $session->session_key);					
						$this->redirect(Yii::app()->user->returnUrl);
					}
				}
			}			
		}
		
		if(isset($_POST['yes']))
		{
			$model = new LoginForm();
			$model->username = Yii::app()->user->getState('uname');
			$model->password = $_POST['password'];
			if($model->validate() && $model->login())
			{
				$session = Session::model()->findByAttributes(array(
						'userid'=> $model->username,
						'session_key'=>Yii::app()->user->getState('existing_key')
				));
				$session->session_key=$this->generateRandomString(32);
				$session->valid_until = time()+Yii::app()->params['timeout'];
				if($session->save())
				{
					Yii::app()->user->setState('session_key', $session->session_key);
					Yii::app()->user->setState('existing_key', '');
					Yii::app()->user->setState('uname', '');
					$this->redirect(Yii::app()->user->returnUrl);
				}
			}
		}
		$error = Yii::app()->user->getFlash('error');
		if(!empty($error))
			$model->addError('username', $error);
		// display the login form
		$this->render('login',array('model'=>$model));
	}	

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		$user = Users::model()->findByPk(Yii::app()->user->getId());
		$user->login_status = Users::LOGGED_OUT;			
		if($user->save())
		{
			Session::model()->deleteAllByAttributes(array('userid'=>$user->username));
			Yii::app()->user->logout();
			$this->redirect(Yii::app()->homeUrl);
		}
		var_dump($user->getErrors());
	}
}