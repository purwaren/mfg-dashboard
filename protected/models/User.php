<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $userid
 * @property string $password
 * @property string $jabatan
 * @property integer $id_profile
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, password, jabatan', 'required'),
			array('id_profile', 'numerical', 'integerOnly'=>true),
			array('userid', 'length', 'max'=>15),
			array('password', 'length', 'max'=>128),
			array('jabatan', 'length', 'max'=>25),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userid, password, jabatan, id_profile', 'safe', 'on'=>'search'),
		);
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
			'userid' => 'Userid',
			'password' => 'Password',
			'jabatan' => 'Jabatan',
			'id_profile' => 'Id Profile',
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
		$criteria->compare('userid',$this->userid,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('jabatan',$this->jabatan,true);
		$criteria->compare('id_profile',$this->id_profile);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave()
	{
		if($this->isNewRecord)
		{
			$this->password = $this->encryptPasswd($this->password);
		}
		return TRUE;
	}
	
	/**
	 * Encrypt users password
	 */
	public function encryptPasswd($str)
	{
		return sha1($str);
	}
	
	/**
	 * Get dosen object
	 */
	public static function getDosen($id)
	{
		$model = User::model()->findByPk($id);
		return Dosen::model()->findByPk($model->id_profile);
	}
	
	/**
	 * Get all role options
	 */
	public static function getAllRoleOptions()
	{
		return array(
			'admin'=>'Admin',
			'dosen'=>'Dosen',
			'mahasiswa'=>'Mahasiswa',
		);
	}
	
	/**
	 * Get all profile
	 */
	public static function getAllProfileDosen()
	{
		$model = Dosen::model()->findAll();
		$options = array();
		if($model)
		{
			foreach($model as $row)
			{
				$options[$row->id] = $row->nama_dosen;
			}
		}
		return $options;
	}
	public static function getAllProfileMahasiswa()
	{
		$model = Mahasiswa::model()->findAll();
		$options = array();
		if($model)
		{
			foreach($model as $row)
			{
				$options[$row->id] = $row->nama_mhs;
			}
		}
		return $options;
	}
}