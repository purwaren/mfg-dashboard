<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $username
 * @property string $passwd
 * @property integer $status
 * @property integer $created_time
 * @property integer $updated_time
 * @property integer $last_login_time
 * @property integer $login_status
 */
class Users extends CActiveRecord
{
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 0;
	const STATUS_BLOCKED = 2;
	const LOGGED_IN = 1;
	const LOGGED_OUT = 0;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, passwd, status', 'required'),
			array('status, created_time, updated_time, last_login_time, login_status', 'numerical', 'integerOnly'=>true),
			array('username, passwd', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, passwd, status, created_time, updated_time, last_login_time, login_status', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * Before save
	 */
	public function beforeSave()
	{
		if($this->isNewRecord)
		{
			$this->last_login_time = 0;
			$this->created_time = time();
			$this->updated_time = 0;			
		}
		return TRUE;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'passwd' => 'Passwd',
			'status' => 'Status',
			'created_time' => 'Created Time',
			'updated_time' => 'Updated Time',
			'last_login_time' => 'Last Login Time',
			'login_status' => 'Login Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('passwd',$this->passwd,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_time',$this->created_time);
		$criteria->compare('updated_time',$this->updated_time);
		$criteria->compare('last_login_time',$this->last_login_time);
		$criteria->compare('login_status',$this->login_status);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Encrypt the password with sha1 hash
	 * @return $str encrypted with sha1
	 */
	public static function encrypt($str) 
	{
		$sha = str_split(sha1($str),4);
		$salt = str_split(Yii::app()->params['salt'],4);
		for($i=1;$i<=8;$i++)
		{
			$sha[$i] = $sha[$i].$salt[$i-1];
		}		
		return sha1(implode($sha));
	}
	
	/**
	 * Verify current users password
	 * @param $passwd
	 */
	public function verifyPassword($passwd)
	{		
		if($this->passwd == $this->encrypt($passwd))
			return TRUE;
		else
			return FALSE;
	}
	
	/**
	 * Get all status options
	 */
	public static function getAllStatusOptions()
	{
		return array(
			self::STATUS_ACTIVE =>'Aktif',
			self::STATUS_INACTIVE =>'Tidak Aktif',
			self::STATUS_BLOCKED => 'Diblokir'
		);
	}
}