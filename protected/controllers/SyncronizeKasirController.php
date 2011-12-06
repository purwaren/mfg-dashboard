<?php

class SyncronizeKasirController extends Controller
{
	
	public function beforeAction($action)
	{
		if(Yii::app()->request->isSecureConnection)
		{
			if($this->authenticate($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']))
			{
				return TRUE;
			}
			else
			{
				echo CJSON::encode(array(
					'status' => 'error',
					'message' => 'Authorization failed',
				)),
				Yii::app()->end();
			}
		}
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionTest()
	{
		$this->var_dump($_POST);
	}
}