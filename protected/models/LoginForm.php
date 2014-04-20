<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// username must be active
			array('username', 'isActive'),
			// password needs to be authenticated
			array('password', 'authenticate'),			
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','Terjadi kesalahan username / password');
		}
	}
	
	/**
    * Verify the user, whether user status is active (1) or not active (0)
    * @return boolean status of the users
    */
    public function isActive($attribute,$params)
    {
        if(!$this->hasErrors())
        {
            $user = Users::model()->findByAttributes(array('username'=>$this->username));
            if($user)
            {
                //check user status
            	if($user->status == Users::STATUS_INACTIVE)
                    $this->addError('username','Username is not active');
                else if($user->status == Users::STATUS_BLOCKED)
                    $this->addError('username','Username was blocked, please contact administrator');
                
                
            }
            else
            {
                $this->addError('username','Username was not found');
            }
        }
    }

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			
			//update login status and last login time
			Users::model()->updateByPk($this->_identity->id, array(
				'login_status'=>Users::STATUS_ACTIVE,
				'last_login_time'=>time(),
			));
				
			//set last activity
			Yii::app()->user->setState('lastActivity', time());
			
			return true;
		}
		else
			return false;
	}
}
