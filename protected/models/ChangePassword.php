<?php
/**
 * Change Password
 * Model container for task updating password
 */
class ChangePassword extends CFormModel
{
	public $username;
	public $old_password;
	public $password;
	public $confirm_password;
	
	/**
	* Declares the validation rules.
	* The rules state that username and password are required,
	* and password needs to be authenticated.
	*/
	public function rules()
	{
		return array(
			array('username, old_password, password, confirm_password', 'required'),
			array('password','valid'),
			array('confirm_password','compare','compareAttribute'=>'password'),
		);
	}
	
	/**
	 * Attribute labels
	 * @see CModel::attributeLabels()
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>'Username',
			'old_password'=>'Password Lama',
			'password'=>'Password Baru',
			'confirm_password'=> 'Konfirmasi Password'
		);
	}
	
	public function valid($param, $attribute)
	{
		if(!$this->hasErrors())
		{
			$model = Users::model()->findByAttributes(array(
				'username'=>$this->username,
				'passwd'=>Users::encrypt($this->old_password)
			));
			if($model === null)
			{
				$this->addError('old_password', 'Password salah');
			}
		}
	}
}