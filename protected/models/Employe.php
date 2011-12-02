<?php

/**
 * This is the model class for table "employe".
 *
 * The followings are the available columns in table 'employe':
 * @property integer $id
 * @property string $nik
 * @property string $name
 * @property string $dob
 * @property string $pob
 * @property string $address
 * @property string $occupation
 */
class Employe extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Employe the static model class
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
		return 'employe';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nik, name, dob, pob, address, occupation', 'required'),
			array('nik', 'length', 'max'=>11),
			array('name, pob, occupation', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nik, name, dob, pob, address, occupation', 'safe', 'on'=>'search'),
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
			'nik' => 'Nik',
			'name' => 'Name',
			'dob' => 'Dob',
			'pob' => 'Pob',
			'address' => 'Address',
			'occupation' => 'Occupation',
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
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('pob',$this->pob,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('occupation',$this->occupation,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}