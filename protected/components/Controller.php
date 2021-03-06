<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public function generateRandomString($length)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
	
	/**
	 * Dump variable
	 */
	public function var_dump($var)
	{
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}

	public function beforeAction($action)
	{
		$this->pageTitle=Yii::app()->name;
		$methods = get_class_methods(ucfirst($this->getId()).'Controller');
		$tes = AllController::model()->findByAttributes(array('name'=>strtolower($this->getId())));
		
		if(empty($tes))
		{
			foreach($methods as $row)
			{
				if(substr($row, 0, 6)=='action' && substr($row, 0, 7) != 'actions')
				{
					$myaction = new AllController();
					$myaction->name=$this->getId();
					$myaction->method=strtolower(substr($row,6));
					$myaction->save();
				}
			}
		}
		//set date default timezone
		date_default_timezone_set(Yii::app()->params['timezone']);	
		
		if(!Yii::app()->user->isGuest)
		{
				
			if($this->hasValidSession())
			{		
				$now = time();
				$lastActivity = Yii::app()->user->getState('lastActivity');
				//echo $lastActivity;
		
				if(($now - $lastActivity) > Yii::app()->params['timeout'])
				{
					Session::model()->deleteAllByAttributes(array('userid'=>Yii::app()->user->getName()));
					Yii::app()->user->clearStates();
					Yii::app()->user->setFlash('error','Tidak ada aktifitas selama '.Yii::app()->params['timeout'].' detik, silahkan login kembali');
		
					Yii::app()->user->loginRequired();
				}
				else
				{
					Yii::app()->user->setState('lastActivity',time());
				}
			}
			else
			{
				
				Yii::app()->user->clearStates();
				Yii::app()->user->setFlash('error','Sesi sudah tidak aktif, silahkan login kembali');
				Yii::app()->user->loginRequired();
			}
		}
		return TRUE;
	}
	
	/**
	 * Check if user has valid session
	 */
	public function hasValidSession()
	{
		$key = Yii::app()->user->getState('session_key');
		$model = Session::model()->findByAttributes(array(
				'userid'=>Yii::app()->user->getName(),
				'session_key'=>$key,
		));
		if(!empty($model))
		{
			if($model->valid_until > time())
			{
				$model->valid_until = time()+Yii::app()->params['timeout'];
				$model->save();
				return TRUE;
			}
			else
			{
				//echo 'siap hapus';
				$model->delete();
				return FALSE;
			}
		}
		else
		{
			//echo 'kosong';
			return FALSE;
		}
	}
	
	/**
	 * Reload all controller and method list
	 */
	public function actionReload()
	{
		if(Yii::app()->request->isAjaxRequest && Yii::app()->request->isPostRequest)
		{
			$methods = get_class_methods(ucfirst($this->getId()).'Controller');
			foreach($methods as $row)
			{
				if(substr($row, 0, 6)=='action' && substr($row, 0, 7) != 'actions')
				{
					$tes = AllController::model()->findByAttributes(array(
							'name'=>strtolower($this->getId()),
							'method'=>strtolower(substr($row,6)),
					));
						
					if(empty($tes))
					{
						$myaction = new AllController();
						$myaction->name=$this->getId();
						$myaction->method=strtolower(substr($row,6));
						$myaction->save();
					}
				}
			}

		}
		else
			echo CJSON::encode(array(
					'error'=>'Akses ditolak'
			));
	}
	
	protected function generateAuthRule()
	{
		$authItem = $this->getId().'_'.$this->getAction()->getId();
		$action = array('index','view','reload');
		if(Yii::app()->user->checkAccess($authItem))
			$action[] = $this->getAction()->getId();
			
		return $action;
	}
	
	protected function checkIfHasAccess($controller, $action)
	{
		$access=$controller.'_'.$action;
		return Yii::app()->user->checkAccess($access);
	}
	
	/**
	 * authenticate the users, if has access, return true
	 */
	protected function authenticate($user, $passwd)
	{
		$user = Users::model()->findByAttributes(array(
			'username' =>$user,
			'passwd' => Users::encrypt($passwd),
		));
		if($user && $user->status == Users::STATUS_ACTIVE)
			return TRUE;
		else return FALSE;		
	}
}